<?php
/**
 * @author Lujie.Zhou(gao_lujie@live.cn)
 * @Date 10/16/2014
 * @Time 10:32 AM
 */

return [
    'core_system' => [     //module name, if module is app, set default
        'label' => Yii::t('core_system', 'System'),
        'sort' => 200,
        'groups' => [
            'setting' => [     //controller name
                'label' => Yii::t('core_system', 'Setting'),
                'sort' => 100,
                'permissions' => [
                    'index' => [
                        'label' => Yii::t('core_system', 'Edit'),
                        'sort' => 10,
                    ],
                ]
            ],
            'dataList' => [
                'label' => Yii::t('core_system', 'DataList'),
                'sort' => 200,
                'permissions' => [
                    'index' => [
                        'label' => Yii::t('core_system', 'List'),
                        'sort' => 10,
                    ],
                    'edit' => [
                        'label' => Yii::t('core_system', 'Edit'),
                        'sort' => 20,
                        'permissionKeys' => ['core_system_dataList_create', 'core_system_dataList_update']
                    ],
                    'delete' => [
                        'label' => Yii::t('core_system', 'Delete'),
                        'sort' => 30,
                    ],
                ]
            ],
            'urlRewrite' => [
                'label' => Yii::t('core_system', 'Url Rewrite'),
                'sort' => 200,
                'permissions' => [
                    'index' => [
                        'label' => Yii::t('core_system', 'List'),
                        'sort' => 10,
                    ],
                    'edit' => [
                        'label' => Yii::t('core_system', 'Edit'),
                        'sort' => 20,
                        'permissionKeys' => ['core_system_urlRewrite_create', 'core_system_urlRewrite_update']
                    ],
                    'delete' => [
                        'label' => Yii::t('core_system', 'Delete'),
                        'sort' => 30,
                    ],
                ]
            ]
        ]
    ],
];