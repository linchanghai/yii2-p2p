<?php
/**
 * @link http://www.yincart.com/
 * @copyright Copyright (c) 2014 Yincart
 * @license http://www.yincart.com/license/
 */

namespace p2p\project\services;


use kiwi\base\Service;
use kiwi\Kiwi;

class ProjectService extends Service
{
    public function autoRepayment()
    {
        $repaymentClass = Kiwi::getProjectRepaymentClass();
        $query = $repaymentClass::find()->andWhere(['is_transfer' => 1]);
        /** @var \p2p\project\models\ProjectRepayment $repayment */
        foreach ($query->each() as $repayment) {
            $repayment->repayment();
        }
    }
} 