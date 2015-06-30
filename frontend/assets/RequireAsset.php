<?php
/**
 * Created by PhpStorm.
 * User: LCH
 * Date: 2015/6/29
 * Time: 10:06
 */

namespace frontend\assets;

use yii\web\AssetBundle;

class RequireAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/style.min.css',
        'css/index.min.css',
    ];
    public $js = [
        'js/require.js',
        'js/requireApp.js',
    ];
    public $depends = [
    ];
}
