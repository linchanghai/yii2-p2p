<?php
/**
 * @link http://www.yincart.com/
 * @copyright Copyright (c) 2014 Yincart
 * @license http://www.yincart.com/license/
 */

namespace p2p\recharge;


use kiwi\Kiwi;
use kiwi\payment\Payment;
use kiwi\payment\PaymentEvent;
use yii\base\BootstrapInterface;
use yii\base\Exception;
use yii\helpers\Json;

class Bootstrap implements BootstrapInterface
{
    public function bootstrap($app)
    {
        $this->attachEvents($app);
    }

    public function attachEvents($app)
    {
        PaymentEvent::on(Payment::className(), Payment::EVENT_FINISH_PAY, [$this, 'updateRechargeRecord']);
        PaymentEvent::on(Payment::className(), Payment::EVENT_FINISH_PAY, [$this, 'updateAccountMoney']);
        PaymentEvent::on(Payment::className(), Payment::EVENT_FINISH_PAY, [$this, 'continuePay']);
    }

    /**
     * @param \kiwi\payment\PaymentEvent $event
     * @throws Exception
     */
    public function updateRechargeRecord($event)
    {
        $rechargeRecordClass = Kiwi::getRechargeRecordClass();
        $rechargeRecord = $rechargeRecordClass::findByTransactionId($event->transactionId);
        if ($event->isError) {
            $rechargeRecord->status = $rechargeRecord::STATUS_ERROR;
        } else {
            if ($event->isSuccessful) {
                $rechargeRecord->status = $rechargeRecord::STATUS_SUCCESS;
            } else {
                $rechargeRecord->status = $rechargeRecord::STATUS_FAIL;
            }
        }
        if (!$rechargeRecord->save()) {
            throw new Exception('Update recharge record error: ' . Json::encode($rechargeRecord->getErrors()));
        }
    }

    /**
     * @param \kiwi\payment\PaymentEvent $event
     * @throws Exception
     */
    public function updateAccountMoney($event)
    {
        if (!$event->isSuccessful) {
            return;
        }

        $rechargeRecordClass = Kiwi::getRechargeRecordClass();
        $rechargeRecord = $rechargeRecordClass::findByTransactionId($event->transactionId);

        $changeRecord = Kiwi::getStatisticChangeRecord();
        $changeRecord->type = $changeRecord::TYPE_RECHARGE;
        $changeRecord->value = $rechargeRecord->money;
        $changeRecord->member_id = $rechargeRecord->member_id;
        $changeRecord->link_id = $rechargeRecord->recharge_record_id;
        if (!$rechargeRecord->save()) {
            throw new Exception('Update account money error: ' . Json::encode($rechargeRecord->getErrors()));
        }
    }

    /**
     * @param \kiwi\payment\PaymentEvent $event
     */
    public function continuePay($event)
    {
        if (!$event->isSuccessful) {
            return;
        }

        $rechargeRecordClass = Kiwi::getRechargeRecordClass();
        $rechargeRecord = $rechargeRecordClass::findByTransactionId($event->transactionId);

        switch($rechargeRecord->use_for_type) {
            case $rechargeRecord::USE_FOR_TYPE_INVEST:
                break;
            case $rechargeRecord::USE_FOR_TYPE_TO_PACKAGE:
                break;
        }
    }
} 