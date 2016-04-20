<?php
/**
 * @copyright Copyright (c) 2015 Kiwi
 */

namespace kiwi\db;
use kiwi\Kiwi;
use yii\base\Exception;

/**
 * Class ChangeLogTrait
 * @package kiwi\db
 * @author jeremy.zhou(gao_lujie@live.cn)
 */
trait ChangeLogTrait
{
    public $logClass;

    public $logValueAttribute = 'value';

    public $logResultAttribute = 'result';

    public $logTypeAttribute = 'type';

    public $logNoteAttribute = 'note';

    public $logMethodPrefix = 'update';

    /**
     * for method updateAccountMoney(100, 'recharge', 'recharge 100')
     * @param $name
     * @param $params
     * @return mixed
     * @inheritdoc
     */
    public function __call($name, $params)
    {
        if (strpos($name, $this->logMethodPrefix) === 0) {
            $prettyAttribute = lcfirst(substr($name, strlen($this->logMethodPrefix)));
            if ($attribute = $this->getAttributeWithPretty($prettyAttribute)) {
                return $this->updateAttributeWithLog($attribute, $params);
            }
        }
        return parent::__call($name, $params);
    }

    public function prettyAttributes()
    {
        /** @var $this ChangeLogTrait|ActiveRecord */
        $attributes = $this->attributes();
        $prettyAttributes = array_map(function ($a) {
            $a = explode('_', $a);
            $a = array_map('ucfirst', $a);
            $a = implode('', $a);
            return $a;
        }, $attributes);
        return array_combine($prettyAttributes, $attributes);
    }

    public function getAttributeWithPretty($prettyAttribute)
    {
        $prettyAttributes = $this->prettyAttributes();
        return isset($prettyAttributes[$prettyAttribute]) ? $prettyAttributes[$prettyAttribute] : null;
    }

    /**
     * @param $attribute
     * @param $params
     * @return bool
     * @throws Exception
     */
    public function updateAttributeWithLog($attribute, $params)
    {
        list($value, $type, $note) = $params;

        /** @var $this ChangeLogTrait|ActiveRecord */
        $this->$attribute += $value;
        if (!$this->save(true, [$attribute])) {
            throw new Exception($this->getFirstError($attribute));
        }

        /** @var ActiveRecord $logInstance */
        $logInstance = Kiwi::createObject(['class' => $this->logClass]);
        $logInstance->setAttributes([
            $this->logValueAttribute => $value,
            $this->logTypeAttribute => $type,
            $this->logNoteAttribute => $note,
            $this->logResultAttribute => $this->getAttribute($attribute),
        ]);
        if (!$logInstance->save()) {
            throw new Exception($logInstance->getErrorsAsString());
        }
        return true;
    }
}