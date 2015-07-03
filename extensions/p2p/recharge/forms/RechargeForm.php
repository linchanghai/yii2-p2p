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

    public function rules()
    {
        $rechargeMethods = Kiwi::getDataListModel()->rechargeMethods;
        $rechargeMethods = array_keys($rechargeMethods);
        return [
            [['money', 'method'], 'required'],
            ['money', 'number', 'integerOnly' => true, 'min' => 1],
            ['method', 'in', 'range' => $rechargeMethods]
        ];
    }

    public function attributeLabels()
    {
        return [
            'money' => Yii::t('p2p_recharge', 'Recharge money'),
            'method' => Yii::t('p2p_recharge', 'Recharge method'),
        ];
    }

    public function pay()
    {
        if (!$this->validate()) {
            return false;
        }
        /** @var \kiwi\payment\Payment $payment */
        $payment = Yii::$app->payment;
        $payment->on($payment::EVENT_BEFORE_PAY, [$this, 'createRechargeRecord']);
        $payment->pay($this->method, $this->money);
        return false;
    }

    /**
     * @param \kiwi\payment\PaymentEvent $event
     */
    public function createRechargeRecord($event)
    {
        $recharge = Kiwi::getRechargeRecord([
            'transaction_id' => $event->transactionId,
            'recharge_type' => $this->method,
            'money' => $event->money,
            'member_id' => Yii::$app->user->id,
        ]);
        if (!$recharge->save()) {
            $event->isValid = false;
        }
        $this->addError('money', Json::encode($recharge->getErrors()));
    }
} 