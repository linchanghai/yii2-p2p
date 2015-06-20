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
class Aop implements Configurable
{
    /** @var AopInfo */
    public $aopInfo;

    #region base object functions override

    public function className()
    {
        return $this->aopInfo->instance->className();
    }

    public function __construct($aopInfo, $config = [])
    {
        $this->aopInfo = $aopInfo;

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
        $this->aopInfo->method = '__get';
        $this->aopInfo->name = $name;

        return $this->_get($name);
    }

    public function __set($name, $value)
    {
        $this->aopInfo->method = '__set';
        $this->aopInfo->name = $name;
        $this->aopInfo->value = $value;

        $this->_set($name, $value);
    }

    public function __isset($name)
    {
        $this->aopInfo->method = '__isset';
        $this->aopInfo->name = $name;

        return $this->_isset($name);
    }

    public function __unset($name)
    {
        $this->aopInfo->method = '__unset';
        $this->aopInfo->name = $name;

        $this->_unset($name);
    }

    public function __call($name, $params)
    {
        $this->aopInfo->method = '__call';
        $this->aopInfo->name = $name;
        $this->aopInfo->params = $params;

        return $this->_call();
    }

    public function hasProperty($name, $checkVars = true)
    {
        return $this->canGetProperty($name, $checkVars) || $this->canSetProperty($name, false);
    }

    public function canGetProperty($name, $checkVars = true)
    {
        return method_exists($this->aopInfo->instance, 'get' . $name) || $checkVars && property_exists($this->aopInfo->instance, $name);
    }

    public function canSetProperty($name, $checkVars = true)
    {
        return method_exists($this->aopInfo->instance, 'set' . $name) || $checkVars && property_exists($this->aopInfo->instance, $name);
    }

    public function hasMethod($name)
    {
        return method_exists($this->aopInfo->instance, $name);
    }

    #endregion base object functions override

    #region function proxy call

    protected function _get($name)
    {
        if (!$this->aopInfo->result = $this->aopInfo->getCache()) {
            $this->aopInfo->result = $this->aopInfo->instance->$name;
            $this->aopInfo->setCache();
        }
        return $this->aopInfo->result;
    }

    protected function _set($name, $value)
    {
        $this->aopInfo->instance->$name = $value;
    }

    protected function _isset($name)
    {
        return isset($this->aopInfo->instance[$name]);
    }

    protected function _unset($name)
    {
        unset($this->aopInfo->instance[$name]);
    }


    protected function _call()
    {
        $this->aopInfo->prepareCall();

        try {
            if ($this->aopInfo->beforeCall()) {
                if (!$this->aopInfo->result = $this->aopInfo->getCache()) {
                    $this->aopInfo->result = call_user_func_array([$this->aopInfo->instance, $this->aopInfo->name], $this->aopInfo->params);
                    $this->aopInfo->setCache();
                }
                $this->aopInfo->afterCall();

                $this->aopInfo->finishCall();

                return $this->aopInfo->result;
            }

            $this->aopInfo->finishCall(true, false);
            return false;
        } catch (Exception $e) {
            $this->aopInfo->exception = $e;
            $this->aopInfo->finishCall(false);
            return false;
        }
    }

    #endregion function proxy call
} 