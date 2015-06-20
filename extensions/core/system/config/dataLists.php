<?php
/**
 * @author Lujie.Zhou(lujie.zhou@jago-ag.cn) 
 * @Date 6/6/2015
 * @Time 5:59 PM
 */

return [
    'boolean' => [
        'label' => Yii::t('app', 'Boolean'),
        'values' => [
            1 => Yii::t('app', 'Yes'),
            0 => Yii::t('app', 'No'),
        ],
        'isDB' => true
    ],
    'enable' => [
        'label' => Yii::t('app', 'Boolean'),
        'values' => [
            1 => Yii::t('app', 'Enable'),
            0 => Yii::t('app', 'Disable'),
        ],
        'isDB' => true
    ],
    'active' => [
        'label' => Yii::t('app', 'Active'),
        'values' => [
            1 => Yii::t('app', 'On'),
            0 => Yii::t('app', 'Off'),
        ],
        'isDB' => true
    ]
];