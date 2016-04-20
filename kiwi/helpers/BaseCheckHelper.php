<?php
/**
 * @author Lujie.Zhou(lujie.zhou@jago-ag.cn) 
 * @Date 5/28/2015
 * @Time 1:14 PM
 */

namespace kiwi\helpers;


class BaseCheckHelper 
{
    public static function isCallable($name)
    {
        return $name && ($name instanceof \Closure) || (is_string($name) && function_exists($name)) || (is_array($name) && is_callable($name, true));
    }
}