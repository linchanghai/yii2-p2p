<?php
/**
 * @link http://www.yincart.com/
 * @copyright Copyright (c) 2014 Yincart
 * @license http://www.yincart.com/license/
 */

namespace kiwi\behaviors;


use yii\base\Behavior;
use yii\db\ActiveRecord;

class AddChangeLogBehavior extends Behavior
{
    public function events()
    {
        return [
            ActiveRecord::EVENT_AFTER_INSERT => 'addChangeLog'
        ];
    }

    public function addChangeLog()
    {

    }
} 