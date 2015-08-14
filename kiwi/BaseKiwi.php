<?php
/**
 * @author Lujie.Zhou(lujie.zhou@jago-ag.cn)
 * @Date 6/2/2015
 * @Time 9:00 PM
 */

namespace kiwi;

use Yii;
use yii\base\UnknownMethodException;
use yii\helpers\ArrayHelper;

class BaseKiwi
{
    /**
     * @var array class map used for class create
     */
    public static $classMap = [];

    public static function __callStatic($name, $arguments)
    {
        if (strlen($name) > 3 && substr($name, 0, 3) === 'get') {
            $className = lcfirst(substr($name, 3));
            if (strlen($name) > 8 && substr($name, -5) === 'Class') {
                $className = lcfirst(substr($name, 3, -5));
                foreach (['singleton', 'class'] as $key) {
                    if (isset(self::$classMap[$key][$className])) {
                        $class = self::$classMap[$key][$className];
                        return is_array($class) ? $class['class'] : $class;
                    }
                }
            }

            $type = ['class' => $className];
            if (isset($arguments[0]) && is_array($arguments[0])) {
                $type = ArrayHelper::merge($type, $arguments[0]);
            }
            $params = isset($arguments[1]) && is_array($arguments[1]) ? $arguments[1] : [];

            return Kiwi::createObject($type, $params);
        }
        throw new UnknownMethodException('Calling unknown method: ' . get_called_class() . "::$name()");
    }

    public static function createObject($type, array $params = [])
    {
        $object = Yii::createObject($type, $params);

        $class = is_string($type) ? $type : $type['class'];
        $aspectConfig = Kiwi::getConfiguration()->aspect;
        if (empty($aspectConfig[$class])) {
            return $object;
        }

        $aspectInfoConfig = ['class' => 'kiwi\base\AopInfo', 'instance' => $object];
        $aspectInfoConfig = ArrayHelper::merge($aspectInfoConfig, $aspectConfig[$class]);
        /** @var \kiwi\base\AspectInfo $aspectInfo */
        $aspectInfo = Yii::createObject($aspectInfoConfig);
        /** @var \kiwi\base\Aspect $aspect */
        $aspect = Yii::createObject('kiwi\base\Aspect', [$aspectInfo]);
        return $aspect;
    }

    /**
     * register class, define the class map
     * @param array $classes the class map
     */
    public static function registerClass(array $classes)
    {
        $classes = static::normalizeClass($classes);

        self::$classMap = ArrayHelper::merge(self::$classMap, $classes);

        if (isset($classes['singleton']) && is_array($classes['singleton'])) {
            foreach ($classes['singleton'] as $name => $class) {
                $params = [];
                if (is_array($class) && isset($class['params'])) {
                    $params = $class['params'];
                    unset($class['params']);
                }
                Yii::$container->setSingleton($name, $class, $params);
            }
        }
        if (isset($classes['class']) && is_array($classes['class'])) {
            foreach ($classes['class'] as $name => $class) {
                $params = [];
                if (is_array($class) && isset($class['params'])) {
                    $params = $class['params'];
                    unset($class['params']);
                }
                Yii::$container->set($name, $class, $params);
            }
        }
    }

    public static function normalizeClass($classes)
    {
        foreach (['singleton', 'class'] as $key) {
            if (isset($classes[$key])) {
                $keys = array_keys($classes[$key]);
                $keys = array_map(function($k) { return lcfirst($k); }, $keys);
                $classes[$key] = array_combine($keys, array_values($classes[$key]));
            }
        }
        return $classes;
    }

    /**
     * @param string $type
     * @param array $params
     * @return Configuration
     * @throws \yii\base\InvalidConfigException
     */
    public static function getConfiguration($type = 'kiwi\Configuration', $params = [])
    {
        return Yii::createObject($type, $params);
    }
}