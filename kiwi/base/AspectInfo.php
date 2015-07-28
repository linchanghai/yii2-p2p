<?php
/**
 * @link http://www.yiikiwi.com/
 * @copyright Copyright (c) 2015 yiikiwi
 * @license http://www.yiikiwi.com/license/
 */

namespace kiwi\base;

use kiwi\helpers\CheckHelper;
use kiwi\Kiwi;
use Yii;
use yii\base\Component;
use yii\base\ModelEvent;
use yii\db\Transaction;

/**
 * Class AopInfo
 *
 * @property string exceptionAsString
 *
 * @package kiwi\base
 * @author jeremy.zhou(gao_lujie@live.cn)
 */
class AspectInfo extends Component
{
    /** @var Model */
    public $instance;

    /** @var string function return value */
    public $result;

    /** @var string the get or set or call function name */
    public $name;

    /** @var string set value */
    public $value;

    /** @var array, call function arguments */
    public $params;

    /** @var string, the magic func, __get / __set / __call / __isset / __unset */
    public $method;

    /** @var \yii\db\Connection */
    public $db;

    /** @var \yii\db\Transaction */
    public $transaction;

    /**
     * @var array
     * ['name' => $isolationLevel|true]
     */
    public $transactionInfo = [];

    /** @var bool */
    public $isThrowException = true;

    /** @var \yii\base\Exception */
    public $exception;

    /** @var \yii\caching\Cache */
    public $cache;

    /**
     * @var array
     * ['name' => ['duration' => '', 'dependency' => '', 'cacheKey' => '', 'getCache' => '', 'setCache' => '']]
     */
    public $cacheInfo = [];

    public function init()
    {
        parent::init();
        if (!$this->cache) {
            $this->cache = Yii::$app->cache;
        }
        if (!$this->db) {
            $this->db = Yii::$app->db;
        }
    }

    public function getExceptionAsString()
    {
        $exceptionInfo = [];
        foreach (['Name', 'Message', 'File', 'Line', 'Code', 'TraceAsString'] as $getKey) {
            $getKey = ucfirst($getKey);
            $getter = 'get' . $getKey;
            $exceptionInfo[] = $getKey . ': ' . $this->exception->{$getter}();
        }
        return implode('; ', $exceptionInfo);
    }

    #region cache

    public function getCacheInfo($key = null, $checkCallable = true, $default = null)
    {
        if (empty($this->cacheInfo[$this->name]) || ($key !== null && empty($this->cacheInfo[$this->name][$key]))) {
            return $default;
        }

        if ($key === null) {
            return $this->cacheInfo[$this->name];
        }

        $info = $this->cacheInfo[$this->name][$key];
        if ($checkCallable && CheckHelper::isCallable($info)) {
            return call_user_func($info, $this);
        }

        return $info;
    }

    public function getCacheKey()
    {
        $cacheKey = $this->instance->className() . '::' . $this->name;
        return $this->getCacheInfo('cacheKey', true, $cacheKey);
    }

    public function getCacheDuration()
    {
        return $this->getCacheInfo('duration', true, 0);
    }

    public function getCacheDependency()
    {
        return $this->getCacheInfo('dependency');
    }

    public function getCache()
    {
        if (!$this->getCacheInfo()) {
            return null;
        }
        if ($getCache = $this->getCacheInfo('getCache', false)) {
            if (CheckHelper::isCallable($getCache)) {
                return call_user_func($getCache, $this);
            }
        }
        if ($cacheKey = $this->getCacheKey()) {
            return $this->cache->get($cacheKey);
        }
        return null;
    }

    public function setCache()
    {
        if (!$this->getCacheInfo()) {
            return null;
        }
        if ($setCache = $this->getCacheInfo('setCache', false)) {
            if (CheckHelper::isCallable($setCache)) {
                call_user_func($setCache, $this);
                return;
            }
        }
        if ($cacheKey = $this->getCacheKey()) {
            $duration = $this->getCacheDuration();
            $dependency = $this->getCacheDependency();
            $this->cache->set($cacheKey, $this->result, $duration, $dependency);
        }
    }

    #endregion cache

    #region events

    /**
     * @param string $eventType before or after
     * @return bool
     */
    protected function triggerEvent($eventType)
    {
        $event = new ModelEvent();

        $className = end(explode('\\', $this->className()));
        $eventName = $eventType . $className;
        $this->trigger($eventName, $event);

        if ($event->isValid) {
            $className = end(explode('\\', $this->instance->className()));
            $eventName = $eventType . $className;
            $this->trigger($eventName, $event);
        }

        if ($event->isValid) {
            $eventName = $eventType . $className . ucfirst($this->name);
            $this->trigger($eventName, $event);
        }

        return $event->isValid;
    }

    public function beforeCall()
    {
        return $this->triggerEvent('beforeCall');
    }

    public function afterCall()
    {
        return $this->triggerEvent('afterCall');
    }

    public function onError()
    {
        return $this->triggerEvent('onError');
    }

    #endregion events

    #region for transaction & profile & log

    public function getTransactionInfo()
    {
        if (empty($this->transactionInfo[$this->name])) {
            return false;
        }

        $isolationLevels = [Transaction::READ_COMMITTED, Transaction::READ_UNCOMMITTED, Transaction::REPEATABLE_READ, Transaction::SERIALIZABLE];
        return in_array($this->transactionInfo[$this->name], $isolationLevels) ? $this->transactionInfo[$this->name] : null;
    }

    public function prepareCall()
    {
        $callName = $this->instance->className() . '::' . $this->name;
        Yii::beginProfile($callName, $callName);

        $isolationLevel = $this->getTransactionInfo();
        if ($isolationLevel !== false) {
            $this->transaction = $this->db->beginTransaction($isolationLevel);
        }
    }

    public function finishCall($isSuccessful = true, $hasRunMethod = true)
    {
        $callName = $this->instance->className() . '::' . $this->name;
        $isolationLevel = $this->getTransactionInfo();

        if ($isSuccessful) {
            if ($isolationLevel !== false) {
                $this->transaction->commit();
            }

            Yii::endProfile($callName, $callName);
            if ($hasRunMethod) {
                Yii::trace("Call {$callName} Success.", __METHOD__);
            } else {
                Yii::trace("Didn't Call {$callName}.", __METHOD__);
            }
        } else {
            if ($isolationLevel !== false) {
                $this->transaction->rollBack();
            }

            $this->onError();

            Yii::endProfile($callName, $callName);
            Yii::warning("Call {$callName} Fail. Exception: {$this->getExceptionAsString()}", __METHOD__);

            if ($this->isThrowException) {
                throw $this->exception;
            }
        }
    }

    #endregion for transaction & profile & log
} 