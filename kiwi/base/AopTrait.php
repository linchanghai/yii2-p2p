<?php
/**
 * @author Lujie.Zhou(lujie.zhou@jago-ag.cn)
 * @Date 5/28/2015
 * @Time 1:53 PM
 */

namespace kiwi\base;

/**
 * Class AopTrait
 * @package kiwi\base
 * @author Lujie.Zhou(lujie.zhou@jago-ag.cn)
 */
Trait AopTrait
{
    public $aopDefault = true;

    public $aopKeysOnly = [];

    public $aopKeysExcept = [];

    private $_aopData = [];

    public function __get($name)
    {
        if (in_array($name, $this->aopKeysOnly) || ($this->aopDefault && !in_array($name, $this->aopKeysExcept))) {
            if (empty($this->_aopData[$name])) {
                if (method_exists($this, '_get')) {
                    $this->_aopData[$name] = $this->_get($name);
                } else {
                    $this->_aopData[$name] = parent::__get($name);
                }
            }
            return $this->_aopData[$name];
        }
        return parent::__get($name);
    }

    public function __set($name, $value)
    {
        if (in_array($name, $this->aopKeysOnly) || ($this->aopDefault && !in_array($name, $this->aopKeysExcept))) {
            $this->_aopData[$name] = $value;
            return;
        }
        parent::__set($name, $value);
    }
}