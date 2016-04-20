<?php
/**
 * Created by PhpStorm.
 * User: LCH
 * Date: 2015/6/29
 * Time: 10:06
 */

namespace frontend\assets;

use yii\web\AssetBundle;
use yii\web\View;

class RequireAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';

    public $js = [
        'js/require.js',
    ];

    public $jsOptions = [
        'position' => View::POS_HEAD
    ];
}
