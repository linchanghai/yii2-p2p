<?php
/**
 * Created by PhpStorm.
 * User: LCH
 * Date: 2015/7/4
 * Time: 16:23
 */

return [
    'package' => [
        'label' => Yii::t('p2p_package', 'Package'),
        'sort' => 3000,
        'url' => ['/p2p_package/package-interest-record/index'],
        'items' => [
            'package' => [
                'label' => Yii::t('p2p_package', 'Package'),
                'sort' => 100,
                'items' => [
                    'package_invest_record' => [
                        'label' => Yii::t('p2p_package', 'Package Interest Record'),
                        'sort' => 100,
                        'url' => ['/p2p_package/package-interest-record/index'],
                    ],
                    'package_into' => [
                        'label' => Yii::t('p2p_package', 'Package Into'),
                        'sort' => 200,
                        'url' => ['/p2p_package/package-record/into-index'],
                    ],
                    'package_out' => [
                        'label' => Yii::t('p2p_package', 'Package out'),
                        'sort' => 300,
                        'url' => ['/p2p_package/package-record/out-index'],
                    ],
                ]
            ]
        ]
    ]
];