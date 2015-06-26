<?php
/**
 * @link http://www.yincart.com/
 * @copyright Copyright (c) 2014 Yincart
 * @license http://www.yincart.com/license/
 */

namespace p2p\activity\behaviors;

use Yii;
use yii\base\Behavior;
use yii\base\Exception;
use yii\db\ActiveRecord;
use yii\helpers\Json;

class RecordBehavior extends Behavior
{
    public $targetClass = 'core\member\models\MemberCoupon';

    /** @var \yii\db\ActiveRecord */
    protected $target;

    public $attributes = [
        'type' => 'ProductMap.type',
        'value' => 'ProductMap.exchange_value',
        'expire_date' => 'ProductMap.duration + time()',
    ];

    public function events()
    {
        return [
            ActiveRecord::EVENT_AFTER_INSERT => 'createRecord',
        ];
    }

    public function createRecord($event)
    {
        $eventModel = $event->sender;
        $model = '';
        $this->target = Yii::createObject($this->targetClass);
        foreach ($this->attributes as $key => $value) {
            $tmp = explode('.', $value);
            if (count($tmp) > 1) {
                if(!$model){
                    $model = $eventModel->$tmp[0];
                }
                $this->target->key = $model->$tmp[1];
            }
        }

        if (!$this->target->save()) {
            throw new Exception('Save target error: ' . Json::encode($this->target));
        }
    }
}