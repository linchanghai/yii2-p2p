<?php
/**
 * @link http://www.yincart.com/
 * @copyright Copyright (c) 2014 Yincart
 * @license http://www.yincart.com/license/
 */

namespace p2p\package\models;

use kiwi\Kiwi;

/**
 * Class MemberStatistic
 *
 * 今天拿到利息的本金
 * = 昨天余额 - 昨天转入金额
 * = 前天余额 - 昨天转出金额
 *
 * @package p2p\package\models
 * @author jeremy.zhou(gao_lujie@live.cn)
 */
class MemberStatistic extends \core\member\models\MemberStatistic
{
    public function autoIntoPackage()
    {
        if (!$this->is_auto_into || !$this->account_money) {
            return false;
        }

        $packageRecord = Kiwi::getPackageRecord();
        $packageRecord->type = $packageRecord::TYPE_INTO;
        $packageRecord->member_id = $this->member_id;
        $packageRecord->exchange_cash = $this->account_money;
        return $packageRecord->save();
    }

    public function createInterestRecord()
    {
        $interest = $this->getTodayInterest();
        if (!$interest) {
            return false;
        }

        $interestRecord = Kiwi::getPackageInterestRecord();
        $interestRecord->member_id = $this->member_id;
        $interestRecord->daily_interest = $interest;
        $interestRecord->target_date = date('Yms');
        return $interestRecord->save();
    }

    /**
     * @return float
     */
    protected function getTodayInterest()
    {
        $rate = 7;
        $principal = $this->getTodayInterestPrincipal();
        $interest = $principal * $rate / 100 / 365;
        return $interest;
    }

    /**
     * @return float get today package money
     */
    protected function getTodayInterestPrincipal()
    {
        $yesterday = strtotime('-1 day');
        $from = strtotime(date('Y-m-d 00:00:00', $yesterday));
        $to = strtotime(date('Y-m-d 23:59:59', $yesterday));

        $packageRecordClass = Kiwi::getPackageRecordClass();
        $intoPackageMoney = $packageRecordClass::getIntoPackageMoney($from, $to, $this->member_id);

        $yesterdayPackageMoney = $this->getYesterdayPackageMoney();
        $principal = $yesterdayPackageMoney - $intoPackageMoney;
        return $principal;
    }

    /**
     * @return float get yesterday package money
     */
    protected function getYesterdayPackageMoney()
    {
        $now = time();
        $from = strtotime(date('Y-m-d 00:00:00', $now));
        $to = strtotime(date('Y-m-d 23:59:59', $now));

        $packageRecordClass = Kiwi::getPackageRecordClass();
        $intoPackageMoney = $packageRecordClass::getIntoPackageMoney($from, $to, $this->member_id);
        $outPackageMoney = $packageRecordClass::getOutPackageMoney($from, $to, $this->member_id);

        $nowPackageMoney = $this->package_money;

        // because $lastDayPackageMoney + $intoPackageMoney - $outPackageMoney = $nowPackageMoney
        $lastDayPackageMoney = $nowPackageMoney + $outPackageMoney - $intoPackageMoney;
        return $lastDayPackageMoney;
    }
} 