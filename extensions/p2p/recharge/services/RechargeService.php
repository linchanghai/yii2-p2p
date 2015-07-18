<?php
/**
 * @link http://www.yincart.com/
 * @copyright Copyright (c) 2014 Yincart
 * @license http://www.yincart.com/license/
 */

namespace p2p\recharge\services;


use kiwi\base\Service;
use kiwi\Kiwi;
use kiwi\payment\Payment;
use kiwi\payment\PaymentEvent;
use yii\base\Exception;
use yii\helpers\Json;

class RechargeService extends Service
{
    public function attachEvents()
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

        $changeRecordClass = Kiwi::getStatisticChangeRecordClass();
        $changeRecord = Kiwi::getStatisticChangeRecord([
            'type' => $changeRecordClass::TYPE_RECHARGE,
            'value' => $rechargeRecord->money,
            'member_id' => $rechargeRecord->member_id,
            'link_id' => $rechargeRecord->recharge_record_id,
        ]);
        if (!$changeRecord->save()) {
            throw new Exception('Update account money error: ' . Json::encode($changeRecord->getErrors()));
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

        switch ($rechargeRecord->use_for_type) {
            case $rechargeRecord::USE_FOR_TYPE_INVEST:
                break;
            case $rechargeRecord::USE_FOR_TYPE_TO_PACKAGE:
                break;
        }
    }
} 