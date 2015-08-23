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
 * Class ChangeBehavior
 *
 * this class is helper to update a value by created record
 *
 * [
 *      'class' => ChangeBehavior::className(),
 *      'targetClass' => 'xxx\models\xxx',
 *      'attribute' => 'xxx',
 *      'condition' => ['member_id' => 'xxx']
 * ]
 *
 * @package kiwi\behaviors
 * @author jeremy.zhou(gao_lujie@live.cn)
 */
class ChangeBehavior extends Behavior
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
        /** @var ActiveRecord $sender */
        $sender = $event->sender;
        if (strpos($sender->className(), 'Search') !== false) {
            return;
        }

        if (CheckHelper::isCallable($this->condition)) {
            $this->condition = call_user_func($this->condition, $event->sender);
        }
        $targetClass = $this->targetClass;
        $this->target = $targetClass::findOne($this->condition);
        if (!$this->target) {
            throw new Exception('Can not find target record');
        }

        $this->target->{$this->attribute} += $sender->{$this->valueAttribute};
        if ($this->resultAttribute) {
            $sender->{$this->resultAttribute} = $this->target->{$this->attribute};
        }

        if (!$this->target->validate()) {
            $sender->addError($this->valueAttribute, Json::encode($this->target->getErrors()));
        }
    }

    /**
     * @param \yii\base\ModelEvent $event
     * @throws Exception
     */
    public function saveChange($event)
    {
        if ($this->target && !$this->target->save(false)) {
            throw new Exception('Save target value error: ' . Json::encode($this->target));
        }
    }
} 