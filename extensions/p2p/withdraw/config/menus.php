<?php

return [
    'capital' => [
        'label' => Yii::t('p2p_recharge', 'CapitalManagement'),
        'sort' => 2100,
        'url' => ['/p2p_recharge/recharge-record/index'],
        'items' => [
            'withdraw' => [
                'label' => Yii::t('p2p_withdraw', 'WithdrawRecord'),
                'sort' => 200,
                'items' => [
                    'pending' => [
                        'label' => Yii::t('p2p_withdraw', 'PendingRecord'),
                        'sort' => 100,
                        'url' => ['/p2p_withdraw/withdraw-record/pending'],
                    ],
                    'first' => [
                        'label' => Yii::t('p2p_withdraw', 'FirstRecord'),
                        'sort' => 200,
                        'url' => ['/p2p_withdraw/withdraw-record/first'],
                    ],
                    'auto' => [
                        'label' => Yii::t('p2p_withdraw', 'AutoRecord'),
                        'sort' => 300,
                        'url' => ['/p2p_withdraw/withdraw-record/auto'],
                    ],
                    'success' => [
                        'label' => Yii::t('p2p_withdraw', 'SuccessRecord'),
                        'sort' => 400,
                        'url' => ['/p2p_withdraw/withdraw-record/success'],
                    ],
                    'fail' => [
                        'label' => Yii::t('p2p_withdraw', 'FailRecord'),
                        'sort' => 500,
                        'url' => ['/p2p_withdraw/withdraw-record/fail'],
                    ],
                ]
            ],

        ]
    ],
];
