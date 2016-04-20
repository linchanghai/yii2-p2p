<?php
/**
 * @link http://www.yiikiwi.com/
 * @copyright Copyright (c) 2015 yiikiwi
 * @license http://www.yiikiwi.com/license/
 */

return [
    'singleton' => [
        'SettingModel' => 'core\system\models\SettingModel',
        'DataListModel' => 'core\system\models\DataListModel',
    ],
    'class' => [
        'Setting' => 'core\system\models\Setting',
        'DataList' => 'core\system\models\DataList',
        'UrlRewrite' => 'core\system\models\UrlRewrite',
        'UrlRewriteSearch' => 'core\system\searches\UrlRewriteSearch',
        'RewriteUrlRule' => 'core\system\rules\RewriteUrlRule',
        'Menu' => 'core\system\models\Menu',
    ],
];
