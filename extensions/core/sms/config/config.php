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
            'sms' => [
                'class' => 'core\sms\services\ZucpSms',
                'useFileTransport' => true,
            ]
        ]
    ],
    'backend' => [
        'components' => [
            'sms' => [
                'class' => 'core\sms\services\ZucpSms',
                'useFileTransport' => true,
            ]
        ]
    ],
];