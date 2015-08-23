<?php
/**
 * Created by PhpStorm.
 * User: LCH
 * Date: 2015/6/27
 * Time: 10:53
 */

use kiwi\Kiwi;

$withdrawRecordClass = Kiwi::getWithdrawRecordClass();
$withdrawFormClass = Kiwi::getWithdrawFormClass();

return [
    'events' => [
        'values' => [
            $withdrawFormClass . '::afterWithdraw' => Yii::t('p2p_withdraw', 'Withdraw'),
        ]
    ],

    'withdrawStatus' => [
        'values' => [
            $withdrawRecordClass::STATUS_PENDING => Yii::t('p2p_withdraw', 'Withdraw Pending'),
            $withdrawRecordClass::STATUS_SUCCESS => Yii::t('p2p_withdraw', 'Withdraw Success'),
            $withdrawRecordClass::STATUS_FAIL => Yii::t('p2p_withdraw', 'Withdraw Fail'),
            $withdrawRecordClass::STATUS_FIRST_VERIFY_SUCCESS => Yii::t('p2p_withdraw', 'Withdraw First Verify Success'),
        ]
    ],

    'withdrawFirstVerifyStatus' => [
        'values' => [
            $withdrawRecordClass::STATUS_FIRST_VERIFY_SUCCESS => Yii::t('p2p_withdraw', 'Withdraw First Verify Success'),
            $withdrawRecordClass::STATUS_FAIL => Yii::t('p2p_withdraw', 'Withdraw Fail'),
        ]
    ],

    'withdrawSecondVerifyStatus' => [
        'values' => [
            $withdrawRecordClass::STATUS_SUCCESS => Yii::t('p2p_withdraw', 'Withdraw Success'),
            $withdrawRecordClass::STATUS_FAIL => Yii::t('p2p_withdraw', 'Withdraw Fail'),
        ]
    ],

    'withdrawType' => [
        'values' => [
            $withdrawRecordClass::TYPE_AUTO => Yii::t('p2p_withdraw', 'Auto Withdraw'),
            $withdrawRecordClass::TYPE_MANUAL => Yii::t('p2p_withdraw', 'Manual Withdraw'),
        ]
    ]
];