<?php
/**
 * @author Lujie.Zhou(lujie.zhou@jago-ag.cn) 
 * @Date 6/6/2015
 * @Time 6:06 PM
 */

return [
    'cms' => [
        'label' => Yii::t('core_cms', 'Cms'),
        'sort' => 2000,
        'url' => ['/core_cms/cms-about/index'],
        'items' => [
            'cms' => [
                'label' => Yii::t('core_cms', 'Cms'),
                'sort' => 100,
                'url' => ['/core_cms/cms-about/index'],
                'items'=>[
                    'cmsAbout' => [
                        'label' => Yii::t('core_cms', 'About'),
                        'sort' => 100,
                        'url' => ['/core_cms/cms-about/index'],
                        'activeUrls' => [['/core_cms/cms-about/create'], ['/core_cms/cms-about/update']],
                    ],
                    'cmsContact' => [
                        'label' => Yii::t('core_cms', 'Contact'),
                        'sort' => 300,
                        'url' => ['/core_cms/cms-contact/index'],
                        'activeUrls' => [['/core_cms/cms-contact/create'], ['/core_cms/cms-contact/update']],
                    ],
                    'cmsHelp' => [
                        'label' => Yii::t('core_cms', 'Help'),
                        'sort' => 400,
                        'url' => ['/core_cms/cms-help/index'],
                        'activeUrls' => [['/core_cms/cms-help/create'], ['/core_cms/cms-help/update']],
                    ],
                    'cmsMedia' => [
                        'label' => Yii::t('core_cms', 'Media'),
                        'sort' => 500,
                        'url' => ['/core_cms/cms-media/index'],
                        'activeUrls' => [['/core_cms/cms-media/create'], ['/core_cms/cms-media/update']],
                    ],
                    'cmsNotice' => [
                        'label' => Yii::t('core_cms', 'Notice'),
                        'sort' => 500,
                        'url' => ['/core_cms/cms-notice/index'],
                        'activeUrls' => [['/core_cms/cms-notice/create'], ['/core_cms/cms-notice/update']],
                    ],
                ]
            ],        ]
    ],
];

