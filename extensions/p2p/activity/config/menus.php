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
                    'exchangeRecord' => [
                        'label' => Yii::t('p2p_activity', 'ExchangeRecord'),
                        'sort' => 300,
                        'url' => ['/p2p_activity/exchange-record/index'],
                        'activeUrls' => [['/p2p_activity/exchange-record/create'], ['/p2p_activity/exchange-record/update']],
                    ],
                    'annualRecord' => [
                        'label' => Yii::t('p2p_activity', 'AnnualRecord'),
                        'sort' => 400,
                        'url' => ['/p2p_activity/coupon-annual-record/index'],
                        'activeUrls' => [['/p2p_activity/coupon-annual-record/create'], ['/p2p_activity/coupon-annual-record/update']],
                    ],
                    'bonusRecord' => [
                        'label' => Yii::t('p2p_activity', 'BonusRecord'),
                        'sort' => 500,
                        'url' => ['/p2p_activity/coupon-bonus-record/index'],
                        'activeUrls' => [['/p2p_activity/coupon-bonus-record/create'], ['/p2p_activity/coupon-bonus-record/update']],
                    ],
                    'cashRecord' => [
                        'label' => Yii::t('p2p_activity', 'CashRecord'),
                        'sort' => 600,
                        'url' => ['/p2p_activity/coupon-cash-record/index'],
                        'activeUrls' => [['/p2p_activity/coupon-cash-record/create'], ['/p2p_activity/coupon-cash-record/update']],
                    ],
                ]
            ]
        ]
    ],
];

