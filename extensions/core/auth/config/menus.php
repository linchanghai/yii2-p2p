<?php
/**
 * @author Lujie.Zhou(lujie.zhou@jago-ag.cn) 
 * @Date 6/6/2015
 * @Time 6:06 PM
 */

return [
    'auth' => [
        'label' => Yii::t('core_auth', 'Auth'),
        'sort' => 600,
        'url' => ['/core_auth/user/index'],
        'items' => [
            'auth' => [
                'label' => Yii::t('core_auth', 'Auth'),
                'sort' => 100,
                'items' => [
                    'user' => [
                        'label' => Yii::t('core_auth', 'User'),
                        'sort' => 100,
                        'url' => ['/core_auth/user/index'],
                        'activeUrls' => [['/core_auth/user/create'], ['/core_auth/user/update']],
                    ],
                    'role' => [
                        'label' => Yii::t('core_auth', 'Role'),
                        'sort' => 200,
                        'url' => ['/core_auth/role/index'],
                        'activeUrls' => [['/core_auth/role/create', '/core_auth/role/update']],
                    ],
                ]
            ]
        ]
    ],
];

