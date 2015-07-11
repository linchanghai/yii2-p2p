<?php
/**
 * @link http://www.yiikiwi.com/
 * @copyright Copyright (c) 2015 yiikiwi
 * @license http://www.yiikiwi.com/license/
 */

namespace kiwi\base;
use yii\base\ModelEvent;

/**
 * Class Model
 * @package kiwi\base
 * @author jeremy.zhou(gao_lujie@live.cn)
 */
class Model extends \yii\base\Model
{
    public function __call($name, $params)
    {
        $method = $name . 'Internal';
        if (method_exists($this, $method)) {
            return $this->callInternal($name,$method);
        }
        parent::__call($name, $params);
    }

    public function callInternal($name, $method){
        if (!$this->validate()) {
            return false;
        }

        if ($this->beforeInternal($name)) {
            $result = $this->$method();
            $this->afterInternal($name);
            return $result;
        }
        return false;
    }

    public function beforeInternal($name)
    {
        $eventName = 'before' . ucfirst($name);
        $event = new ModelEvent();
        $this->trigger($eventName, $event);
        return $event->isValid;
    }

    public function afterInternal($name)
    {
        $eventName = 'after' . ucfirst($name);
        $this->trigger($eventName);
    }
} 