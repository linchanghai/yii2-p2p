<?php
/**
 * Created by PhpStorm.
 * Author: changhai.lin<1079140464@qq.com>
 * Date: 2015/8/3
 * Time: 11:28
 */

return [
    'transfer' => [
        'label' => Yii::t('p2p_transfer', 'Transfer'),
        'sort' => 450,
        'url' => ['/p2p_transfer/transfer/index'],
        'items' => [
            'transfer' => [
                'label' => Yii::t('p2p_transfer', 'Transfer'),
                'sort' => 100,
                'items' => [
                    'pending' => [
                        'label' => Yii::t('p2p_transfer', 'Pending Check'),
                        'sort' => 100,
                        'url' => ['/p2p_transfer/transfer/index'],
                        'activeUrls' => [['/p2p_transfer/transfer/update']]
                    ],
                    'passed' => [
                        'label' => Yii::t('p2p_transfer', 'Passed Check'),
                        'sort' => 200,
                        'url' => ['/p2p_transfer/transfer-passed/index'],
                        'activeUrls' => [['/p2p_transfer/transfer-passed/update']]
                    ],
                    'failed' => [
                        'label' => Yii::t('p2p_transfer', 'Failed Check'),
                        'sort' => 300,
                        'url' => ['/p2p_transfer/transfer-failed/index'],
                        'activeUrls' => [['/p2p_transfer/transfer-failed/update']]
                    ],
                    'end' => [
                        'label' => Yii::t('p2p_transfer', 'Transfer End'),
                        'sort' => 400,
                        'url' => ['/p2p_transfer/transfer-end/index'],
                        'activeUrls' => [['/p2p_transfer/transfer-end/update']]
                    ],
                ]
            ]
        ]
    ]
];