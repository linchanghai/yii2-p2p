<?php
/**
 * @link http://www.yincart.com/
 * @copyright Copyright (c) 2014 Yincart
 * @license http://www.yincart.com/license/
 */

namespace core\member\models;

use kiwi\Kiwi;

/**
 * Class MemberTrait
 *
 * @property Member $member
 * @property MemberBank $memberBank
 * @property MemberStatus $memberStatus
 * @property MemberStatistic $memberStatistic
 * @property MemberCoupon[] $memberCoupons
 * @property MemberCoupon[] $memberCashCoupons
 * @property MemberCoupon[] $memberAnnualCoupons
 * @property \p2p\activity\models\ActivityRecord[] $activityRecords
 * @property \p2p\activity\models\ExchangeRecord[] $exchangeRecords
 * @property \p2p\activity\models\CouponBonusRecord[] $couponBonusRecords
 * @property \p2p\activity\models\CouponCashRecord[] $couponCashRecords
 * @property \p2p\activity\models\CouponAnnualRecord[] $couponAnnualRecords
 * @property \p2p\recharge\models\RechargeRecord[] $rechargeRecords
 * @property \p2p\withdraw\models\WithdrawRecord[] $withdrawRecords
 * @property \p2p\package\models\PackageRecord[] $packageRecords
 * @property \p2p\package\models\PackageInterestRecord[] $packageInterestRecords
 * @property \p2p\project\models\ProjectInvest[] $projectInvests
 * @property \p2p\project\models\ProjectRepayment[] $projectRepayments
 *
 * @package core\member\models
 * @author jeremy.zhou(gao_lujie@live.cn)
 */
trait MemberTrait
{
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMember()
    {
        return $this->hasOne(Kiwi::getMemberClass(), ['member_id' => 'member_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMemberBank()
    {
        return $this->hasOne(Kiwi::getMemberBankClass(), ['member_id' => 'member_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMemberStatus()
    {
        return $this->hasOne(Kiwi::getMemberStatusClass(), ['member_id' => 'member_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMemberStatistic()
    {
        return $this->hasOne(Kiwi::getMemberStatisticClass(), ['member_id' => 'member_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMemberCoupons()
    {
        return $this->hasMany(Kiwi::getMemberCouponClass(), ['member_id' => 'member_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMemberCashCoupons()
    {
        $memberCouponClass = Kiwi::getMemberCouponClass();
        return $this->hasMany($memberCouponClass, ['member_id' => 'member_id'])
            ->andWhere(['type' => $memberCouponClass::TYPE_CASH, 'status' => $memberCouponClass::STATUS_UNUSED]);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMemberAnnualCoupons()
    {
        $memberCouponClass = Kiwi::getMemberCouponClass();
        return $this->hasMany($memberCouponClass, ['member_id' => 'member_id'])
            ->andWhere(['type' => $memberCouponClass::TYPE_ANNUAL, 'status' => $memberCouponClass::STATUS_UNUSED]);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getActivityRecords()
    {
        return $this->hasMany(Kiwi::getActivityRecordClass(), ['member_id' => 'member_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getExchangeRecords()
    {
        return $this->hasMany(Kiwi::getExchangeRecordClass(), ['member_id' => 'member_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCouponAnnualRecords()
    {
        return $this->hasMany(Kiwi::getCouponAnnualRecordClass(), ['member_id' => 'member_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCouponBonusRecords()
    {
        return $this->hasMany(Kiwi::getCouponBonusRecordClass(), ['member_id' => 'member_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCouponCashRecords()
    {
        return $this->hasMany(Kiwi::getCouponCashRecordClass(), ['member_id' => 'member_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRechargeRecords()
    {
        return $this->hasMany(Kiwi::getRechargeRecordClass(), ['member_id' => 'member_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWithdrawRecords()
    {
        return $this->hasMany(Kiwi::getWithdrawRecordClass(), ['member_id' => 'member_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPackageRecords()
    {
        return $this->hasMany(Kiwi::getPackageRecordClass(), ['member_id' => 'member_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPackageInterestRecords()
    {
        return $this->hasMany(Kiwi::getPackageInterestRecordClass(), ['member_id' => 'member_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProjectInvests()
    {
        return $this->hasMany(Kiwi::getProjectInvestClass(), ['member_id' => 'member_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProjectRepayments()
    {
        return $this->hasMany(Kiwi::getProjectRepaymentClass(), ['member_id' => 'member_id']);
    }
}