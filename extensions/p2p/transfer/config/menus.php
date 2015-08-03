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
                        'label' => Yii::t('p2p_transfer', 'Transfer'),
                        'sort' => 100,
                        'url' => ['/p2p_transfer/transfer/index'],
                        'activeUrls' => [['/p2p_transfer/transfer/update']]
                    ],
                ]
            ]
        ]
    ]
];