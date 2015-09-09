<?php

return [
    'capital' => [
        'label' => Yii::t('p2p_recharge', 'CapitalManagement'),
        'sort' => 200,
        'url' => ['/p2p_recharge/recharge-record/index'],
        'items' => [
            'capital' => [
                'label' => Yii::t('p2p_recharge', 'CapitalManagement'),
                'sort' => 100,
                'items' => [
                    'recharge' => [
                        'label' => Yii::t('p2p_recharge', 'RechargeRecord'),
                        'sort' => 100,
                        'url' => ['/p2p_recharge/recharge-record/index'],
                        'activeUrls' => [['/p2p_recharge/recharge-record/create'], ['/p2p_recharge/recharge-record/update']],
                    ],

                ]
            ],

        ]
    ],
];

