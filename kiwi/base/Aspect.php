<?php
/**
 * @link http://www.yiikiwi.com/
 * @copyright Copyright (c) 2015 yiikiwi
 * @license http://www.yiikiwi.com/license/
 */

namespace kiwi\base;

use Yii;
use yii\base\Configurable;
use yii\base\Exception;

/**
 * Class ServiceAOP
 * @package kiwi\base
 * @author jeremy.zhou(gao_lujie@live.cn)
 */
class Aspect implements Configurable
{
    /** @var AspectInfo */
    public $aspectInfo;

    #region base object functions override

    public function className()
    {
        return $this->aspectInfo->instance->className();
    }

    public function __construct($aspectInfo, $config = [])
    {
        $this->aspectInfo = $aspectInfo;

        if (!empty($config)) {
            Yii::configure($this, $config);
        }
        $this->init();
    }

    public function init()
    {
    }

    public function __get($name)
    {
        $this->aspectInfo->method = '__get';
        $this->aspectInfo->name = $name;

        return $this->_get($name);
    }

    public function __set($name, $value)
    {
        $this->aspectInfo->method = '__set';
        $this->aspectInfo->name = $name;
        $this->aspectInfo->value = $value;

        $this->_set($name, $value);
    }

    public function __isset($name)
    {
        $this->aspectInfo->method = '__isset';
        $this->aspectInfo->name = $name;

        return $this->_isset($name);
    }

    public function __unset($name)
    {
        $this->aspectInfo->method = '__unset';
        $this->aspectInfo->name = $name;

        $this->_unset($name);
    }

    public function __call($name, $params)
    {
        $this->aspectInfo->method = '__call';
        $this->aspectInfo->name = $name;
        $this->aspectInfo->params = $params;

        return $this->_call();
    }

    public function hasProperty($name, $checkVars = true)
    {
        return $this->canGetProperty($name, $checkVars) || $this->canSetProperty($name, false);
    }

    public function canGetProperty($name, $checkVars = true)
    {
        return method_exists($this->aspectInfo->instance, 'get' . $name) || $checkVars && property_exists($this->aspectInfo->instance, $name);
    }

    public function canSetProperty($name, $checkVars = true)
    {
        return method_exists($this->aspectInfo->instance, 'set' . $name) || $checkVars && property_exists($this->aspectInfo->instance, $name);
    }

    public function hasMethod($name)
    {
        return method_exists($this->aspectInfo->instance, $name);
    }

    #endregion base object functions override

    #region function proxy call

    protected function _get($name)
    {
        if (!$this->aspectInfo->result = $this->aspectInfo->getCacheValue()) {
            $this->aspectInfo->result = $this->aspectInfo->instance->$name;
            $this->aspectInfo->setCacheValue();
        }
        return $this->aspectInfo->result;
    }

    protected function _set($name, $value)
    {
        $this->aspectInfo->instance->$name = $value;
    }

    protected function _isset($name)
    {
        return isset($this->aspectInfo->instance[$name]);
    }

    protected function _unset($name)
    {
        unset($this->aspectInfo->instance[$name]);
    }


    protected function _call()
    {
        $this->aspectInfo->prepareCall();

        try {
            if ($this->aspectInfo->beforeCall()) {
                if (!$this->aspectInfo->result = $this->aspectInfo->getCacheValue()) {
                    $this->aspectInfo->result = call_user_func_array([$this->aspectInfo->instance, $this->aspectInfo->name], $this->aspectInfo->params);
                    $this->aspectInfo->setCacheValue();
                }
                $this->aspectInfo->afterCall();

                $this->aspectInfo->finishCall();

                return $this->aspectInfo->result;
            }

            $this->aspectInfo->finishCall(true, false);
            return false;
        } catch (Exception $e) {
            $this->aspectInfo->exception = $e;
            $this->aspectInfo->finishCall(false);
            return false;
        }
    }

    #endregion function proxy call
} 