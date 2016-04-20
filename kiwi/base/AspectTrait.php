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
Trait AspectTrait
{
    protected $aspectDefault = true;

    protected $aspectKeysOnly = [];

    protected $aspectKeysExcept = [];

    private $_aspectData = [];

    /**
     * @param $name
     * @return bool
     */
    public function isAspect($name)
    {
        return in_array($name, $this->aspectKeysOnly) || ($this->aspectDefault && !in_array($name, $this->aspectKeysExcept));
    }

    public function __get($name)
    {
        if ($this->isAspect($name)) {
            if (empty($this->_aspectData[$name])) {
                if (method_exists($this, '_get')) {
                    $this->_aspectData[$name] = $this->_get($name);
                } else {
                    $this->_aspectData[$name] = parent::__get($name);
                }
            }
            return $this->_aspectData[$name];
        }
        return parent::__get($name);
    }

    public function __set($name, $value)
    {
        if ($this->isAspect($name)) {
            $this->_aspectData[$name] = $value;
            return $this;
        }
        parent::__set($name, $value);
    }
}