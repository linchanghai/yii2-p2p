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
use yii\base\Event;
use yii\base\Exception;

class AnnualService extends Service
{
    public function attachEvents()
    {
        Event::on(Kiwi::getInvestFormClass(), 'afterValidate', [$this, 'changeInterestRate']);
        Event::on(Kiwi::getInvestFormClass(), 'afterInvest', [$this, 'useAnnual']);
    }

    /**
     * @param \yii\base\ModelEvent $event
     */
    public function changeInterestRate($event)
    {
        /** @var \p2p\project\forms\InvestForm $investForm */
        $investForm = $event->sender;
        if ($investForm->annual_id) {
            /** @var \core\member\models\MemberCoupon $annualCoupon */
            $annualCoupon = Kiwi::getMemberCoupon()->findOne($investForm->annual_id);
            $investForm->project->interest_rate += $annualCoupon->value;
        }
    }

    /**
     * @param \yii\base\ModelEvent $event
     * @throws Exception
     */
    public function useAnnual($event)
    {
        /** @var \p2p\project\forms\InvestForm $investForm */
        $investForm = $event->sender;
        if (!$investForm->annual_id) {
            return;
        }
        /** @var \core\member\models\MemberCoupon $annualCoupon */
        $annualCoupon = Kiwi::getMemberCoupon()->findOne($investForm->annual_id);
        $annualCoupon->used_time = time();
        $annualCoupon->status = $annualCoupon::STATUS_USED;
        if (!$annualCoupon->save()) {
            throw new Exception('Update Annual Coupon Error!');
        }
        $annualRecord = Kiwi::getCouponAnnualRecord();
        $annualRecord->member_id = Yii::$app->user->id;
        $annualRecord->project_id = $investForm->project->project_id;
        $annualRecord->project_invest_id = $investForm->invest->project_invest_id;
        $annualRecord->member_coupon_id = $annualCoupon->member_coupon_id;
        $annualRecord->rate = $annualCoupon->value;

        $InterestHelperClass = Kiwi::getInterestHelperClass();
        list($totalInterestMoney, $repayments) = $InterestHelperClass::calculateInterest($investForm->investMoney, $annualRecord->rate, time(), $investForm->project->repayment_date, 20);
        $annualRecord->interest_money = $totalInterestMoney;
        if (!$annualRecord->save()) {
            throw new Exception('Save Annual Record Error!');
        }
    }
} 