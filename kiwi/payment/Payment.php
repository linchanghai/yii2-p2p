<?php
/**
 * @author Lujie.Zhou(lujie.zhou@jago-ag.cn)
 * @Date 12/16/2014
 * @Time 3:16 PM
 */

namespace kiwi\payment;


use kiwi\Kiwi;
use Yii;
use yii\base\Component;
use yii\base\InvalidValueException;
use yii\helpers\Url;

/**
 * Class BasePayment
 *
 * @property BasePaymentMethod paymentMethod
 *
 * @package core\payment\services
 * @author Lujie.Zhou(lujie.zhou@jago-ag.cn)
 */
class Payment extends Component implements PaymentInterface
{
    const EVENT_BEFORE_PAY = 'beforePay';
    const EVENT_AFTER_PAY = 'afterPay';
    const EVENT_FINISH_PAY = 'finishPay';

    public $useLocalPay = false;

    /** @var BasePaymentMethod */
    protected $paymentMethod;

    public $methods = [];

    public $callbackUrl = '';

    public $returnUrl = '';

    public function getPaymentMethod()
    {
        return $this->paymentMethod;
    }

    public function setPaymentMethod($method)
    {
        if ($this->useLocalPay) {
            $this->paymentMethod = Yii::createObject('kiwi\payment\LocalPay');
        } else if (isset($this->methods[$method])) {
            $this->paymentMethod = Yii::createObject($this->methods[$method]);
        } else {
            throw new InvalidValueException();
        }

        $this->paymentMethod->callbackUrl = Url::to([$this->callbackUrl, 'method' => $method]);
        $this->paymentMethod->returnUrl = Url::to([$this->returnUrl, 'method' => $method]);
    }

    public function pay($method, $money)
    {
        $this->setPaymentMethod($method);

        if (!$this->beforePay($money)) {
            return false;
        }

        Yii::info('Pay money "' . $money . '" with "' . $this->className() . '"', __METHOD__);

        $this->sendPaymentRequest($money);

        $this->afterPay($money);
    }

    public function callback($method, $data)
    {
        $this->setPaymentMethod($method);

        $isError = !$this->paymentMethod->validateCallbackData($data);
        $isSuccessful = !$isError && $this->paymentMethod->validatePaymentStatus($data);
        $transactionId = $this->paymentMethod->getCallbackId($data);
        $this->finishPay($data, $transactionId, $isSuccessful, $isError);
    }

    protected function sendPaymentRequest($money)
    {
        $this->renderRequestForm($this->paymentMethod->prepareRequestData($money));
        return true;
    }

    protected function renderRequestForm($data)
    {
        $viewFile = '@kiwi/payment/views/pay.php';
        Yii::$app->response->content = Yii::$app->view->render($viewFile, ['data' => $data], $this);
        Yii::$app->response->send();
    }

    public function beforePay($money)
    {
        $event = new PaymentEvent();
        $event->money = $money;
        $event->transactionId = $this->paymentMethod->getId();
        $this->trigger(self::EVENT_BEFORE_PAY, $event);
        return $event->isValid;
    }

    public function afterPay($money)
    {
        $event = new PaymentEvent();
        $event->money = $money;
        $event->transactionId = $this->paymentMethod->getId();
        $this->trigger(self::EVENT_AFTER_PAY, $event);
    }

    public function finishPay($data, $transactionId, $isSuccessful, $isError)
    {
        $event = new PaymentEvent();
        $event->callbackData = $data;
        $event->transactionId = $transactionId;
        $event->isSuccessful = $isSuccessful;
        $event->isError = $isError;
        $this->trigger(self::EVENT_FINISH_PAY, $event);
    }
}