<?php
/**
 * @author Lujie.Zhou(lujie.zhou@jago-ag.cn)
 * @Date 6/6/2015
 * @Time 6:04 PM
 */

return [
    'sms' => [
        'label' => Yii::t('core_sms', 'Sms'),
        'sort' => 1000,
        'groups' => [
            'config' => [
                'label' => Yii::t('core_sms', 'Sms Config'),
                'sort' => 10,
                'fields' => [
                    'zucpSn' => [
                        'label' => Yii::t('core_sms', 'Zucp Sn'),
                        'sort' => 10,
                        'inputType' => 'text',
                        'value' => 'SDK-WSS-010-08768',
                        'hint' => Yii::t('core_sms', 'the zucp sn'),
                    ],
                    'zucpPwd' => [
                        'label' => Yii::t('core_sms', 'Zucp Password'),
                        'sort' => 20,
                        'inputType' => 'password',
                        'value' => 'b@dfca@4',
                        'hint' => Yii::t('core_sms', 'the zucp password'),
                    ],
                    'sucpSuffix' => [
                        'label' => Yii::t('core_sms', 'Zucp Sign'),
                        'sort' => 30,
                        'inputType' => 'text',
                        'value' => '[悦富喵]',
                        'hint' => Yii::t('core_sms', 'the zucp password'),
                    ],
                ]
            ],
        ]
    ],
];