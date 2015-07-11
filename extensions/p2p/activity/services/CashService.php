<?php
/**
 * @link http://www.yiikiwi.com/
 * @copyright Copyright (c) 2015 yiikiwi
 * @license http://www.yiikiwi.com/license/
 */

namespace p2p\activity\services;


use kiwi\base\Service;
use kiwi\Kiwi;
use Yii;
use yii\base\Exception;

class CashService extends Service
{
    public function attachEvents()
    {
        Event::on(Kiwi::getInvestFormClass(), 'beforeInvest', [$this, 'changeInvestMoney']);
        Event::on(Kiwi::getInvestFormClass(), 'afterInvest', [$this, 'useCash']);
    }

    /**
     * @param \yii\base\ModelEvent $event
     */
    public function changeInvestMoney($event)
    {
        /** @var \p2p\project\forms\InvestForm $investForm */
        $investForm = $event->sender;
        if ($investForm->cash_id) {
            /** @var \core\member\models\MemberCoupon $cashCoupon */
            $cashCoupon = Kiwi::getMemberCoupon()->findOne($investForm->cash_id);
            $investForm->invest->actual_invest_money -= $cashCoupon->value;
        }
    }

    /**
     * @param \yii\base\ModelEvent $event
     * @throws Exception
     */
    public function useCash($event)
    {
        /** @var \p2p\project\forms\InvestForm $investForm */
        $investForm = $event->sender;
        if (!$investForm->cash_id) {
            return;
        }
        /** @var \core\member\models\MemberCoupon $cashCoupon */
        $cashCoupon = Kiwi::getMemberCoupon()->findOne($investForm->cash_id);
        $cashRecord = Kiwi::getCouponCashRecord();
        $cashRecord->member_id = Yii::$app->user->id;
        $cashRecord->project_id = $investForm->project->project_id;
        $cashRecord->project_invest_id = $investForm->invest->project_invest_id;
        $cashRecord->member_coupon_id = $cashCoupon->member_coupon_id;
        $cashRecord->discount_money = $cashCoupon->value;
        if (!$cashRecord->save()) {
            throw new Exception('Save Cash Record Error!');
        }
    }
} 