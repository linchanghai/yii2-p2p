<?php
/**
 * @link http://www.yincart.com/
 * @copyright Copyright (c) 2014 Yincart
 * @license http://www.yincart.com/license/
 */

namespace kiwi\behaviors;


use yii\base\Behavior;
use yii\base\Exception;
use yii\db\ActiveRecord;
use yii\helpers\Json;

/**
 * Class ChangeLogBehavior
 *
 * [
 *      'types' => [
 *          'typeXXX' => [
 *              'class' => 'xxx\models\xxx'
 *              'attribute' => 'xxx'
 *          ]
 *      ]
 * ]
 *
 * @property \yii\db\ActiveRecord $owner
 *
 * @package kiwi\behaviors
 * @author jeremy.zhou(gao_lujie@live.cn)
 */
class ChangeLogBehavior extends Behavior
{
    public $types;

    public $typeAttribute;

    public $valueAttribute;

    public $resultAttribute;

    public $linkAttribute;

    public $targetConditions;

    /** @var \yii\db\ActiveRecord */
    protected $target;

    public function events()
    {
        return [
            ActiveRecord::EVENT_BEFORE_INSERT => 'initChange',
            ActiveRecord::EVENT_AFTER_INSERT => 'saveChange',
        ];
    }

    public function initChange()
    {
        if (empty($this->types[$this->{$this->typeAttribute}])) {
            throw new Exception('Error type');
        }

        /** @var ActiveRecord $class */
        $class = $this->types[$this->owner->{$this->typeAttribute}]['class'];
        $attribute = $this->types[$this->owner->{$this->typeAttribute}]['attribute'];
        $this->target = $class::findOne($this->targetConditions);
        if (!$this->target) {
            throw new Exception('Can not find target record');
        }
        $this->target->$attribute += $this->owner->{$this->valueAttribute};

        $this->owner->{$this->resultAttribute} = $this->target->$attribute;
    }

    public function saveChange()
    {
        if ($this->target->save()) {
            throw new Exception('Save target value error: ' . Json::encode($this->target->getErrors()));
        }
    }
} 