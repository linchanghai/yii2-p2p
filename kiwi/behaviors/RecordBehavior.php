<?php
/**
 * @link http://www.yincart.com/
 * @copyright Copyright (c) 2014 Yincart
 * @license http://www.yincart.com/license/
 */

namespace kiwi\behaviors;

use kiwi\helpers\CheckHelper;
use Yii;
use yii\base\Behavior;
use yii\base\Exception;
use yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;
use yii\helpers\Json;

/**
 * Class RecordBehavior
 *
 * this class is helper to create a record automatically
 *
 * [
 *      'class' => RecordBehavior::className(),
 *      'targetClass' => 'xxx\models\xxxRecord',
 *      'attributes' => [
 *          'type' => 'xxxType',
 *          'value' => 'xxxValue',
 *          'xxx' => [$this, 'getXXX'],
 *          'xx' => function($model) { return 'xx'; }
 *      ],
 * ]
 *
 * @package p2p\activity\behaviors
 * @author wucangzhou(wucangzhou@gmail.com)
 */
class RecordBehavior extends Behavior
{
    /** @var string the target class need to be created */
    public $targetClass = '';

    /** @var array the attributes map that can instance of target class */
    public $attributes = [];

    public $saveTime = 1;

    /** @var string the attribute show the errors of record */
    public $errorAttribute = 'record';

    /** @var \yii\db\ActiveRecord */
    protected $target;

    public function events()
    {
        return [
            ActiveRecord::EVENT_AFTER_VALIDATE => 'validateRecord',
            ActiveRecord::EVENT_AFTER_INSERT => 'createRecord',
        ];
    }

    /**
     * @param \yii\base\ModelEvent $event
     * @throws \yii\base\InvalidConfigException
     */
    public function validateRecord($event)
    {
        /** @var ActiveRecord $sender */
        $sender = $event->sender;
        if (strpos($sender->className(), 'Search') !== false) {
            return;
        }

        $targetConfig = [];
        $this->attributes = array_merge($this->attributes, ['saveTime' => $this->saveTime]);
        foreach ($this->attributes as $key => $value) {
            if (is_int($value)) {
                $targetConfig[$key] = $value;
            } else if (CheckHelper::isCallable($value)) {
                $targetConfig[$key] = call_user_func($value, $sender);
            } else {
                $targetConfig[$key] = ArrayHelper::getValue($sender, $value) ?: $value;
            }
        }
        $targetConfig['class'] = $this->targetClass;

        $this->saveTime = (int)$targetConfig['saveTime'];
        unset($targetConfig['saveTime']);

        $this->target = Yii::createObject($targetConfig);

        if (!$this->target->validate()) {
            $sender->addError($this->errorAttribute, Json::encode($this->target->getErrors()));
        }
    }

    /**
     * @param \yii\base\ModelEvent $event
     * @throws Exception
     */
    public function createRecord($event)
    {
        if (!$this->target) {
            return;
        }

        $times = $this->saveTime;
        while ($times--) {
            $target = clone($this->target);
            if (!$target->save()) {
                throw new Exception('Save target error: ' . Json::encode($this->target));
            }
        }
    }
}