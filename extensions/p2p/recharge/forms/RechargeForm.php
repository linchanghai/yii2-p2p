<?php
/**
 * @link http://www.yincart.com/
 * @copyright Copyright (c) 2014 Yincart
 * @license http://www.yincart.com/license/
 */

namespace p2p\recharge\forms;


use kiwi\base\Model;
use kiwi\Kiwi;
use Yii;
use yii\base\InvalidValueException;
use yii\helpers\Json;

class RechargeForm extends Model
{
    public $money;

    public $method;

    public $rechargeConfig = [];

    public function pay()
    {
        $this->setPaymentMethod();
        /** @var \kiwi\payment\BasePayment $recharge */
        $recharge = Yii::$app->payment;
        $recharge->on($recharge::EVENT_BEFORE_PAY, [$this, 'beforePay']);
        $recharge->pay($this->money);
    }

    public function setPaymentMethod()
    {
        if (empty($this->rechargeConfig[$this->method])) {
            throw new InvalidValueException(Yii::t('p2p_recharge', 'Error recharge method'));
        }
        $rechargeConfig = $this->rechargeConfig[$this->method];
        Yii::$app->setComponents(['recharge' => $rechargeConfig]);
    }

    /**
     * @param \kiwi\payment\PaymentEvent $event
     */
    public function beforePay($event)
    {
        $recharge = Kiwi::getRechargeRecord([
            'transaction_id' => $event->transactionId,
            'recharge_type' => $this->method,
            'money' => $this->money,
            'member_id' => Yii::$app->user->id,
        ]);
        if (!$recharge->save()) {
            $event->isValid = false;
        }
        $this->addError('money', Json::encode($recharge->getErrors()));
    }
} 