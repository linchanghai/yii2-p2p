<?php
/**
 * @author Lujie.Zhou(gao_lujie@live.cn)
 * @Date 10/15/2014
 * @Time 9:40 AM
 */

namespace core\area;


/**
 * Class Module
 *
 * @method array getPermissions()
 * @method array getAdmins()
 *
 * @package core\auth
 * @author Lujie.Zhou(gao_lujie@live.cn)
 */
class Module extends \kiwi\base\Module
{
    public static $active = true;

    public static $version = 'v0.1.0';
} 