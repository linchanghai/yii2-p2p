<?php
/**
 * @link http://www.yincart.com/
 * @copyright Copyright (c) 2014 Yincart
 * @license http://www.yincart.com/license/
 */

use kiwi\Kiwi;

$rechargeFormClass = Kiwi::getRechargeFormClass();

return [
    'events' => [
        'values' => [
            $rechargeFormClass . '::afterRecharge' => Yii::t('p2p_recharge', 'Recharge'),
        ],
    ],

    'rechargeMethods' => [
        'values' => [
            'localPay' => 'LocalPay'
        ]
    ]
];