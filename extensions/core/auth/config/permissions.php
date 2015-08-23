<?php
/**
 * @author Lujie.Zhou(gao_lujie@live.cn)
 * @Date 10/16/2014
 * @Time 10:32 AM
 */

return [
    'core_auth' => [     //module name, if module is app, set the app id
        'label' => Yii::t('core_auth', 'Auth'),
        'sort' => 100,
        'groups' => [
            'user' => [     //controller name
                'label' => Yii::t('core_auth', 'Administrator'),
                'sort' => 100,
                'permissions' => [
                    'index' => [    //action name
                        'label' => Yii::t('core_auth', 'List'),
                        'sort' => 10,
                    ],
                    'edit' => [
                        'label' => Yii::t('core_auth', 'Edit'),
                        'sort' => 20,
                        'permissionKeys' => ['core_auth_user_create', 'core_auth_user_update']
                    ],
                    'delete' => [
                        'label' => Yii::t('core_auth', 'Delete'),
                        'sort' => 30,
                    ],
                ]
            ],
            'role' => [
                'label' => Yii::t('core_auth', 'Role'),
                'sort' => 200,
                'permissions' => [
                    'index' => [
                        'label' => Yii::t('core_auth', 'List'),
                        'sort' => 10,
                    ],
                    'edit' => [
                        'label' => Yii::t('core_auth', 'Edit'),
                        'sort' => 20,
                        'permissionKeys' => ['core_auth_role_create', 'core_auth_role_update']
                    ],
                    'delete' => [
                        'label' => Yii::t('core_auth', 'Delete'),
                        'sort' => 30,
                    ],
                ]
            ]
        ]
    ],
];