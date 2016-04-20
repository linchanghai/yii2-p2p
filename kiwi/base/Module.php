<?php
/**
 * @link http://www.yiikiwi.com/
 * @copyright Copyright (c) 2015 yiikiwi
 * @license http://www.yiikiwi.com/license/
 */

namespace kiwi\base;

use Yii;

/**
 * Class Module
 *
 * for kiwi module
 *
 * @package kiwi\base
 * @author jeremy.zhou(gao_lujie@live.cn)
 */
class Module extends \yii\base\Module
{
    public static $key;

    public static $version = 'v0.1.0';

    public static $active = false;

    public static $depends = [];

    public static $config = [];

    public static $only = [];

    public static $except = [];

    public static $bootstrap = [];

    public function init()
    {
        parent::init();
        $this->initControllerNamespace();
        $this->initViewPath();
    }

    public function initControllerNamespace()
    {
        $this->controllerNamespace = $this->controllerNamespace . '\\' . Yii::$app->id;
    }

    public function initViewPath()
    {
        $this->setViewPath($this->getBasePath() . DIRECTORY_SEPARATOR . 'views' . DIRECTORY_SEPARATOR . Yii::$app->id);
    }
} 