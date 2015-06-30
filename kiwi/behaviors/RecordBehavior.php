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

    public function events()
    {
        return [
            ActiveRecord::EVENT_AFTER_INSERT => 'createRecord',
        ];
    }

    /**
     * @param \yii\base\ModelEvent $event
     * @throws Exception
     */
    public function createRecord($event)
    {
        $target = Yii::createObject($this->targetClass);
        foreach ($this->attributes as $key => $value) {
            if (CheckHelper::isCallable($value)) {
                $target->$key = call_user_func($value, $event->sender);
            } else if (is_string($value)) {
                $target->$key = ArrayHelper::getValue($event->sender, $value);
            } else {
                throw new Exception('Error attribute');
            }
        }

        if (!$target->save()) {
            throw new Exception('Save target error: ' . Json::encode($target));
        }
    }
}