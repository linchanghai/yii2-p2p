<?php
/**
 * @link http://www.yincart.com/
 * @copyright Copyright (c) 2014 Yincart
 * @license http://www.yincart.com/license/
 */

return [
    'member' => [
        'label' => Yii::t('core_member', 'Member Manage'),
        'sort' => 100,
        'url' => ['/core_member/member/index'],
        'items' => [
            'member' => [
                'label' => Yii::t('core_member', 'Member Manage'),
                'sort' => 100,
                'url' => ['/core_member/member/index'],
                'items' => [
                    'member' => [
                        'label' => Yii::t('core_member', 'Member'),
                        'sort' => 100,
                        'url' => ['/core_member/member/index'],
                        'activeUrls' => [['/core_member/member/create'], ['/core_member/member/update']],
                    ],
                ]
            ],
        ],
    ],
];