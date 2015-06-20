<?php
/**
 * @author Lujie.Zhou(lujie.zhou@jago-ag.cn)
 * @Date 6/6/2015
 * @Time 6:04 PM
 */

return [
    'siteConfig' => [
        'label' => Yii::t('app', 'site config'),
        'sort' => 100,
        'groups' => [
            'config' => [
                'label' => Yii::t('app', 'main config'),
                'sort' => 10,
                'fields' => [
                    'siteTitle' => [
                        'label' => Yii::t('app', 'site title'),
                        'sort' => 10,
                        'inputType' => 'text',
                        'value' => 'kiwi site',
                        'hint' => Yii::t('app', 'site title show in browser at home page, if the code not set'),
                    ],
                    'siteKeywords' => [
                        'label' => Yii::t('app', 'site keywords'),
                        'sort' => 20,
                        'inputType' => 'text',
                        'value' => 'kiwi keywords',
                        'hint' => Yii::t('app', 'site keywords for seo'),
                    ],
                    'siteDescription' => [
                        'label' => Yii::t('app', 'site description'),
                        'sort' => 20,
                        'inputType' => 'text',
                        'value' => 'kiwi description',
                        'hint' => Yii::t('app', 'site description for seo'),
                    ],
                ]
            ],
        ]
    ],
];