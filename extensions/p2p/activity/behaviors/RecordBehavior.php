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
//        'expire_date' => function() {
//            return time() + 'ProductMap.duration'
//        },
    ];

    public function events()
    {
        return [
            ActiveRecord::EVENT_AFTER_INSERT => 'createRecord',
        ];
    }

    public function createRecord()
    {
        $this->target = Yii::createObject($this->targetClass);



        if (!$this->target->save()) {
            throw new Exception('Save target error: ' . Json::encode($this->target));
        }
    }
} 