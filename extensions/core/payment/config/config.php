<?php
/**
 * Created by PhpStorm.
 * User: chalin
 * Date: 6/23/2015
 * Time: 8:25 PM
 */

return [
    'frontend' => [
        'components' => [
            'payment' => [
                'class' => 'kiwi\payment\Payment',
                'useLocalPay' => true,
                'methods' => [
                    'Baofoo' => [
                        'class' => 'core\payment\services\Baofoo',
                        'memberID' => '',
                        'terminalID' => '',
                        'pKey' => '',
                    ],
                    'ChinaBank' => [
                        'class' => 'core\payment\services\ChinaBank',
                        'mid' => '',
                        'mKey' => '',
                    ],
                    'Ecpss' => [
                        'class' => 'core\payment\services\Ecpss',
                        'merNo' => '',
                        'MD5key' => '',
                    ],
                    'Sumapay' => [
                        'class' => 'core\payment\services\Sumapay',
                        'partner' => '',
                        'key' => '',
                    ],
                ],
                'callbackUrl' => '/pay/callback'
            ]
        ],
        'controllerMap' => [
            'pay' => 'kiwi\payment\PayController',
            'local-pay' => 'kiwi\payment\LocalPayServerController'
        ]
    ],
];