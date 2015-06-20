<?php
/**
 * @author Lujie.Zhou(lujie.zhou@jago-ag.cn) 
 * @Date 6/6/2015
 * @Time 6:06 PM
 */

return [
    'auth' => [
        'label' => Yii::t('app', 'Auth'),
        'sort' => 1500,
        'url' => ['core_auth'],
        'items' => [
            'user' => [
                'label' => Yii::t('core_auth', 'User'),
                'sort' => 100,
                'url' => ['/core_auth/user/index'],
            ],
            'role' => [
                'label' => Yii::t('core_auth', 'Role'),
                'sort' => 200,
                'url' => ['/core_auth/role/index'],
            ],
        ]
    ],
];

