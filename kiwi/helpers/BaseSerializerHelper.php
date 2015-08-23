<?php
/**
 * @author Lujie.Zhou(lujie.zhou@jago-ag.cn)
 * @Date 6/2/2015
 * @Time 4:03 PM
 */

namespace kiwi\helpers;


class BaseSerializerHelper
{
    public static function encode($value, $serializer = 'json')
    {
        if (is_array($value)) {
            if ($serializer == 'json') {
                return json_encode($value);
            }
            if ($serializer == 'serialize') {
                return serialize($value);
            }
            if (is_array($serializer) && $serializer = $serializer[0]) {
                if (is_callable($serializer)) {
                    return call_user_func($serializer, $value);
                }
            }
        }
        return false;
    }

    public static function decode($value, $isArray = true, $serializer = 'json')
    {
        if (!is_array($value)) {
            if ($serializer == 'json') {
                return json_decode($value, $isArray);
            }
            if ($serializer == 'serialize') {
                return unserialize($value);
            }
            if (is_array($serializer) && $serializer = $serializer[1]) {
                if (is_callable($serializer)) {
                    return call_user_func($serializer, $value);
                }
            }
        }
        return false;
    }
}