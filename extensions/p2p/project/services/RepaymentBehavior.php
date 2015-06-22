<?php
/**
 * @link http://www.yincart.com/
 * @copyright Copyright (c) 2014 Yincart
 * @license http://www.yincart.com/license/
 */

namespace p2p\project\services;


use yii\base\Behavior;
use yii\db\ActiveRecord;

class RepaymentBehavior extends Behavior
{
    public function events()
    {
        return [ActiveRecord::EVENT_AFTER_INSERT => 'createRepayments'];
    }

    public function createRepayments()
    {
        /** @var \p2p\project\models\ProjectInvest $invest */
        $invest = $this->owner;
        foreach ($invest->getRepayments() as $repayment)
        {
            $repayment->save();
        }
    }
} 