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

/**
 * Class BasePayment
 * @package core\payment\services
 * @author Lujie.Zhou(lujie.zhou@jago-ag.cn)
 */
abstract class BasePayment extends Component implements PaymentInterface
{
    const EVENT_BEFORE_PAY = 'beforePay';
    const EVENT_AFTER_PAY = 'afterPay';
    const EVENT_FINISH_PAY = 'finishPay';

    public $useLocalPay;

    public $requestUrl;

    public $callbackUrl;

    public $returnUrl;

    private $_id;

    public function getId()
    {
        if (!$this->_id) {
            $this->_id = $this->generateId();
        }
        return $this->_id;
    }

    /**
     * @return string generate the transaction no
     */
    abstract public function generateId();

    public function pay($money)
    {
        if (!$this->beforePay($money)) {
            return false;
        }

        Yii::info('Pay money "' . $money . '" with "' . $this->className() . '"', __METHOD__);

        $this->sendPaymentRequest($money);

        $this->afterPay($money);
    }

    public function callback($data)
    {
        $isError = !$this->validateCallbackData($data);
        $isSuccessful = !$isError && $this->validatePaymentStatus($data);
        $this->finishPay($data, $isSuccessful, $isError);
    }

    protected function sendPaymentRequest($money)
    {
        $this->renderRequestForm($this->prepareRequestData($money));
        return true;
    }

    protected function renderRequestForm($data)
    {
        $viewFile = '@kiwi/payment/views/pay.php';
        Yii::$app->response->content = Yii::$app->view->render($viewFile, ['data' => $data], $this);
        Yii::$app->response->send();
    }

    /**
     * @param $money
     * @return array
     */
    abstract protected function prepareRequestData($money);

    /**
     * @param $data
     * @return bool check if the signature data is correct
     */
    abstract protected function validateCallbackData($data);

    /**
     * @param $data
     * @return bool check if the payment is successful
     */
    abstract protected function validatePaymentStatus($data);

    public function beforePay($money)
    {
        $event = new PaymentEvent();
        $event->money = $money;
        $this->trigger(self::EVENT_BEFORE_PAY, $event);
        return $event->isValid;
    }

    public function afterPay($money)
    {
        $event = new PaymentEvent();
        $event->money = $money;
        $this->trigger(self::EVENT_AFTER_PAY, $event);
    }

    public function finishPay($data, $isSuccessful, $isError)
    {
        $event = new PaymentEvent();
        $event->callbackData = $data;
        $event->isSuccessful = $isSuccessful;
        $event->isError = $isError;
        $this->trigger(self::EVENT_FINISH_PAY, $event);
    }
}