<?php
/**
 * @link http://www.yiikiwi.com/
 * @copyright Copyright (c) 2015 yiikiwi
 * @license http://www.yiikiwi.com/license/
 */

namespace core\member;


class Module extends \kiwi\base\Module
{
    public static $active = true;

    public static $version = 'v0.2.0';

    public static $bootstrap = ['core\member\Bootstrap'];
} 