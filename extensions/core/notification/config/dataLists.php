<?php
/**
 * @link http://www.yincart.com/
 * @copyright Copyright (c) 2014 Yincart
 * @license http://www.yincart.com/license/
 */

return [
    'notificationType' => [
        'label' => Yii::t('core_notification', 'Notification type'),
        'values' => [
            'mail' => Yii::t('core_notification', 'Email'),
            'sms' => Yii::t('core_notification', 'Sms'),
            'message' => Yii::t('core_notification', 'Message'),
        ]
    ],
    'notificationEvents' => [
        'label' => Yii::t('core_notification', 'Events'),
        'values' => [
            
        ]
    ]
];