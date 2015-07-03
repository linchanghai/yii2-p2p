<?php

return [
    'activity' => [
        'label' => Yii::t('p2p_activity', 'Activity'),
        'sort' => 2000,
        'url' => ['/p2p_activity/product/index'],
        'items' => [
            'activity' => [
                'label' => Yii::t('p2p_activity', 'Activity'),
                'sort' => 300,
                'items' => [
                    'activity' => [
                        'label' => Yii::t('p2p_activity', 'Activity'),
                        'sort' => 100,
                        'url' => ['/p2p_activity/activity/index'],
                        'activeUrls' => [['/p2p_activity/activity/create'], ['/p2p_activity/activity/update']],
                    ],
                    'product' => [
                        'label' => Yii::t('p2p_activity', 'Product'),
                        'sort' => 200,
                        'url' => ['/p2p_activity/product/index'],
                        'activeUrls' => [['/p2p_activity/product/create'], ['/p2p_activity/product/update']],
                    ],
                ]
            ]
        ]
    ],
];

