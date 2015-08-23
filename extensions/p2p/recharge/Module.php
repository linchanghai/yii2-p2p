<?php
/**
 * @author Lujie.Zhou(lujie.zhou@jago-ag.cn) 
 * @Date 2014/11/10
 * @Time 20:11
 */

namespace p2p\recharge;

/**
 * Class Module
 * @package p2p\recharge
 * @author jeremy.zhou(gao_lujie@live.cn)
 */
class Module extends \kiwi\base\Module
{
    public static $active = true;

    public static $version = 'v0.1.0';

    public static $bootstrap = ['p2p\recharge\Bootstrap'];
}