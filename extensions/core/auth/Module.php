<?php
/**
 * @link http://www.yiikiwi.com/
 * @copyright Copyright (c) 2015 yiikiwi
 * @license http://www.yiikiwi.com/license/
 */

namespace core\auth;


class Module extends \kiwi\base\Module
{
    public static $active = true;

    public static $config = ['permissions'];

    public static $bootstrap = ['core\auth\Bootstrap'];

    public static $only = ['backend'];
} 