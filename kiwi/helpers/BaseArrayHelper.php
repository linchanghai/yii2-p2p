<?php
/**
 * @author Lujie.Zhou(lujie.zhou@jago-ag.cn) 
 * @Date 6/11/2015
 * @Time 8:59 PM
 */

namespace kiwi\helpers;


use yii\helpers\ArrayHelper;

class BaseArrayHelper extends ArrayHelper
{
    public static function sortByKey($array, $childKeys = 'items', $sortKey = 'sort')
    {
        uasort($array, function ($a, $b) use ($sortKey) {
            if (empty($a[$sortKey]) || empty($b[$sortKey]) || $a[$sortKey] == $b[$sortKey]) {
                return 0;
            }
            return ($a[$sortKey] < $b[$sortKey]) ? -1 : 1;
        });

        if ($childKeys) {
            if (is_array($childKeys)) {
                $childKey = array_shift($childKeys);
            } else {
                $childKey = $childKeys;
            }

            foreach ($array as $key => $childArray) {
                if (isset($childArray[$childKey])) {
                    $array[$key][$childKey] = static::sortByKey($array[$key][$childKey], $childKeys, $sortKey);
                }
            }
        }

        return $array;
    }

    public static function filter($array, $childKeys, $func)
    {
        $array = array_filter($array, $func);

        if ($childKeys) {
            if (is_array($childKeys)) {
                $childKey = array_shift($childKeys);
            } else {
                $childKey = $childKeys;
            }

            foreach ($array as $key => $childArray) {
                if (isset($childArray[$childKey])) {
                    $array[$key][$childKey] = static::filter($array[$key][$childKey], $childKeys, $func);
                    if (empty($array[$key][$childKey])) {
                        unset($array[$key]);
                    }
                }
            }
        }

        return $array;
    }
}