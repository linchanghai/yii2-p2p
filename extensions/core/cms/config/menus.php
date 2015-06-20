<?php
/**
 * @author Lujie.Zhou(lujie.zhou@jago-ag.cn) 
 * @Date 6/6/2015
 * @Time 6:06 PM
 */

return [
    'cms' => [
        'label' => Yii::t('app', 'Cms'),
        'sort' => 2000,
        'url' => ['core_cms'],
        'items' => [
            'category' => [
                'label' => Yii::t('core_cms', 'Category'),
                'sort' => 100,
                'url' => ['/core_cms/category/index'],
            ],
            'article' => [
                'label' => Yii::t('core_cms', 'Article'),
                'sort' => 300,
                'url' => ['/core_cms/article/index'],
            ],
            'page' => [
                'label' => Yii::t('core_cms', 'Page'),
                'sort' => 400,
                'url' => ['/core_cms/page/index'],
            ],
            'block' => [
                'label' => Yii::t('core_cms', 'Block'),
                'sort' => 500,
                'url' => ['/core_cms/block/index'],
            ],
        ]
    ],
];

