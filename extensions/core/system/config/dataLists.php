<?php
/**
 * @author Lujie.Zhou(lujie.zhou@jago-ag.cn) 
 * @Date 6/6/2015
 * @Time 5:59 PM
 */

return [
    'boolean' => [
        'label' => Yii::t('core_system', 'Boolean'),
        'values' => [
            1 => Yii::t('core_system', 'Yes'),
            0 => Yii::t('core_system', 'No'),
        ],
        'isDB' => true
    ],
    'enable' => [
        'label' => Yii::t('core_system', 'Boolean'),
        'values' => [
            1 => Yii::t('core_system', 'Enable'),
            0 => Yii::t('core_system', 'Disable'),
        ],
        'isDB' => true
    ],
    'active' => [
        'label' => Yii::t('core_system', 'Active'),
        'values' => [
            1 => Yii::t('core_system', 'On'),
            0 => Yii::t('core_system', 'Off'),
        ],
        'isDB' => true
    ]
];