<?php
/**
 * @author Lujie.Zhou(lujie.zhou@jago-ag.cn)
 * @Date 6/6/2015
 * @Time 6:04 PM
 */

return [
    'P2P' => [
        'label' => Yii::t('p2p_package', 'P2P config'),
        'sort' => 100,
        'groups' => [
            'package' => [
                'label' => Yii::t('p2p_package', 'Package config'),
                'sort' => 10,
                'fields' => [
                    'packageRate' => [
                        'label' => Yii::t('p2p_package', 'Package Rate'),
                        'sort' => 10,
                        'inputType' => 'text',
                        'value' => '7',
                        'hint' => Yii::t('p2p_package', 'the package rate, 7 means 7%'),
                    ],
                ]
            ],
        ]
    ],
];