<?php
/**
 * Created by PhpStorm.
 * User: LCH
 * Date: 2015/6/27
 * Time: 10:53
 */

use p2p\withdraw\models\WithdrawRecord;

return [
    'withdrawStatus' => [
        'values' => [
            WithdrawRecord::STATUS_PENDING => Yii::t('p2p_withdraw', 'Withdraw Pending'),
            WithdrawRecord::STATUS_SUCCESS => Yii::t('p2p_withdraw', 'Withdraw Success'),
            WithdrawRecord::STATUS_FAIL => Yii::t('p2p_withdraw', 'Withdraw Fail'),
            WithdrawRecord::STATUS_FIRST_VERIFY_SUCCESS => Yii::t('p2p_withdraw', 'Withdraw First Verify Success'),
        ]
    ],

    'withdrawSecondVerifyStatus' => [
        'values' => [
            WithdrawRecord::STATUS_SUCCESS => Yii::t('p2p_withdraw', 'Withdraw Success'),
            WithdrawRecord::STATUS_FAIL => Yii::t('p2p_withdraw', 'Withdraw Fail'),
        ]
    ],


    'WithdrawType' => [
        'values' => [
            WithdrawRecord::TYPE_AUTO => Yii::t('p2p_withdraw', 'Auto Withdraw'),
            WithdrawRecord::TYPE_MANUAL => Yii::t('p2p_withdraw', 'Manual Withdraw'),
        ]
    ]
];