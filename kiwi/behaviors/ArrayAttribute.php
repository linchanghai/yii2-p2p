<?php
/**
 * @link http://www.yiikiwi.com/
 * @copyright Copyright (c) 2015 yiikiwi
 * @license http://www.yiikiwi.com/license/
 */

namespace kiwi\behaviors;


use kiwi\helpers\SerializerHelper;
use yii\behaviors\AttributeBehavior;
use yii\db\ActiveRecord;

/**
 * Class ArrayAttribute
 * @package kiwi\behaviors
 * @author jeremy.zhou(gao_lujie@live.cn)
 */
class ArrayAttribute extends AttributeBehavior
{
    /**
     * @var array the columns saved with json format
     * for example:
     * ['jsonEncode', 'jsonDecode']
     */
    public $attributes = [];

    public $isArray = true;

    /** @var string json or serialize or callable function */
    public $serializer = 'json';

    public function init()
    {
        $events = [
            ActiveRecord::EVENT_AFTER_FIND,
            ActiveRecord::EVENT_AFTER_INSERT,
            ActiveRecord::EVENT_AFTER_UPDATE,
            ActiveRecord::EVENT_BEFORE_INSERT,
            ActiveRecord::EVENT_BEFORE_UPDATE,
        ];
        $this->attributes = array_fill_keys($events, $this->attributes);
    }

    /**
     * Evaluates the attribute value and assigns it to the current attributes.
     * @param \yii\base\Event $event
     */
    public function evaluateAttributes($event)
    {
        if (!empty($this->attributes[$event->name])) {
            $attributes = (array)$this->attributes[$event->name];
            if (strpos($event->name, 'after') !== false) {
                foreach ($attributes as $attribute) {
                    $this->owner->$attribute = SerializerHelper::decode($this->owner->$attribute, $this->isArray, $this->serializer);
                }
            } else if (strpos($event->name, 'before') !== false) {
                foreach ($attributes as $attribute) {
                    $this->owner->$attribute = SerializerHelper::encode($this->owner->$attribute, $this->serializer);
                }
            }
        }
    }


} 