<?php
/**
 * @link http://www.yiikiwi.com/
 * @copyright Copyright (c) 2015 yiikiwi
 * @license http://www.yiikiwi.com/license/
 */

return [
    'category' => [
        'label' => Yii::t('app', 'Category'),
        'sort' => 3000,
        'url' => ['core_category'],
        'items' => [
            'category' => [
                'label' => Yii::t('core_category', 'Category'),
                'sort' => 100,
                'url' => ['/core_category/category/index'],
                'linkOptions' => ['data-pjax' => '0']
            ],
        ]
    ]
];