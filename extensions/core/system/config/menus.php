<?php
/**
 * @author Lujie.Zhou(lujie.zhou@jago-ag.cn)
 * @Date 6/6/2015
 * @Time 6:06 PM
 */

return [
    'dashboard' => [
        'label' => Yii::t('core_system', 'Home'),
        'sort' => 100,
        'url' => ['/site/index'],
    ],
    'system' => [
        'label' => Yii::t('core_system', 'System'),
        'sort' => 700,
        'url' => ['/core_system/setting/index'],
        'items' => [
            'system' => [
                'label' => Yii::t('core_system', 'System'),
                'sort' => 100,
                'items' => [
                    'setting' => [
                        'label' => Yii::t('core_system', 'Setting'),
                        'sort' => 100,
                        'url' => ['/core_system/setting/index'],
                    ],
                    'dataList' => [
                        'label' => Yii::t('core_system', 'DataList'),
                        'sort' => 200,
                        'url' => ['/core_system/data-list/index'],
                        'activeUrls' => [['/core_system/data-list/create'], ['/core_system/data-list/update']],
                    ],
                    'urlRewrite' => [
                        'label' => Yii::t('core_system', 'UrlRewrite'),
                        'sort' => 300,
                        'url' => ['/core_system/url-rewrite/index'],
                        'activeUrls' => [['/core_system/url-rewrite/create'], ['/core_system/url-rewrite/update']],
                    ],
                ]
            ]
        ]
    ],
];

