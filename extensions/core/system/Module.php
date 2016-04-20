<?php
/**
 * @link http://www.yiikiwi.com/
 * @copyright Copyright (c) 2015 yiikiwi
 * @license http://www.yiikiwi.com/license/
 */

namespace core\system;


class Module extends \kiwi\base\Module
{
    public static $version = 'v0.3.0';

    public static $active = true;

    public static $config = ['settings', 'dataLists', 'menus'];

    public static $bootstrap = ['core\system\Bootstrap'];
} 