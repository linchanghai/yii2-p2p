<?php
/**
 * @author Lujie.Zhou(lujie.zhou@jago-ag.cn)
 * @Date 6/6/2015
 * @Time 6:06 PM
 */

return [
    'system' => [
        'items' => [
            'system' => [
                'items' => [
                    'notification' => [
                        'label' => Yii::t('core_notification', 'notification'),
                        'sort' => 500,
                        'url' => ['/core_notification/notification-template/index'],
                        'activeUrls' => [['/core_notification/notification-template/create'], ['/core_notification/notification-template/update']],
                    ]
                ]
            ]
        ]
    ],
];

