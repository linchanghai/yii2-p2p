<?php
/**
 * @link http://www.yincart.com/
 * @copyright Copyright (c) 2014 Yincart
 * @license http://www.yincart.com/license/
 */

namespace kiwi\behaviors;


use kiwi\helpers\CheckHelper;
use yii\base\Behavior;
use yii\base\Exception;
use yii\db\ActiveRecord;
use yii\helpers\Json;

/**
 * Class ChangeLogBehavior
 *
 * this class is helper to update a value by created record
 *
 * [
 *      'class' => ChangeLogBehavior::className(),
 *      'targetClass' => 'xxx\models\xxx',
 *      'attribute' => 'xxx',
 *      'condition' => ['member_id' => 'xxx']
 * ]
 *
 * @package kiwi\behaviors
 * @author jeremy.zhou(gao_lujie@live.cn)
 */
class ChangeLogBehavior extends Behavior
{
    /** @var ActiveRecord */
    public $targetClass;

    public $attribute;

    public $condition;

    public $valueAttribute = 'value';

    public $resultAttribute = 'result';

    /** @var \yii\db\ActiveRecord */
    protected $target;

    public function events()
    {
        return [
            ActiveRecord::EVENT_AFTER_VALIDATE => 'validateChange',
            ActiveRecord::EVENT_AFTER_INSERT => 'saveChange',
        ];
    }

    public function validateChange($event)
    {
        if (CheckHelper::isCallable($this->condition)) {
            $this->condition = call_user_func($this->condition, $event->sender);
        }
        $targetClass = $this->targetClass;
        $this->target = $targetClass::findOne($this->condition);
        if (!$this->target) {
            throw new Exception('Can not find target record');
        }

        /** @var ActiveRecord $record */
        $record = $event->sender;
        $this->target->{$this->attribute} += $record->{$this->valueAttribute};
        if ($this->resultAttribute) {
            $record->{$this->resultAttribute} = $this->target->{$this->attribute};
        }

        if (!$this->target->validate()) {
            $record->addError($this->valueAttribute, Json::encode($this->target->getErrors()));
        }
    }

    /**
     * @param \yii\base\ModelEvent $event
     * @throws Exception
     */
    public function saveChange($event)
    {
        if (!$this->target->save(false)) {
            throw new Exception('Save target value error: ' . Json::encode($this->target));
        }
    }
} 