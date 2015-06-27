<?php
/**
 * @link http://www.yincart.com/
 * @copyright Copyright (c) 2014 Yincart
 * @license http://www.yincart.com/license/
 */

namespace p2p\package;


use kiwi\base\Service;
use kiwi\Kiwi;
use Yii;

/**
 * Class PackageService
 *
 * 今天拿到利息的本金
 * = 昨天余额 - 昨天转入金额
 * = 前天余额 - 昨天转出金额
 *
 * @package p2p\package
 * @author jeremy.zhou(gao_lujie@live.cn)
 */
class PackageService extends Service
{
    public function getTodayInterest()
    {
        $rate = 7;
        $principal = $this->getTodayInterestPrincipal();
        $interest = $principal * $rate / 100 / 365;
        return $interest;
    }

    /**
     *
     */
    public function getTodayInterestPrincipal()
    {
        $yesterday = strtotime('-1 day');
        $from = strtotime(date('Y-m-d 00:00:00', $yesterday));
        $to = strtotime(date('Y-m-d 23:59:59', $yesterday));

        $packageRecordClass = Kiwi::getPackageRecordClass();
        $intoPackageMoney = $packageRecordClass::getIntoPackageMoney($from, $to, Yii::$app->user->id);

        $yesterdayPackageMoney = $this->getYesterdayPackageMoney();
        $principal = $yesterdayPackageMoney - $intoPackageMoney;
        return $principal;
    }

    /**
     *
     * @return float get last day package money
     */
    public function getYesterdayPackageMoney()
    {
        $now = time();
        $from = strtotime(date('Y-m-d 00:00:00', $now));
        $to = strtotime(date('Y-m-d 23:59:59', $now));

        $packageRecordClass = Kiwi::getPackageRecordClass();
        $intoPackageMoney = $packageRecordClass::getIntoPackageMoney($from, $to, Yii::$app->user->id);
        $outPackageMoney = $packageRecordClass::getOutPackageMoney($from, $to, Yii::$app->user->id);

        /** @var \core\member\models\Member $member */
        $member = Yii::$app->user->identity;
        $nowPackageMoney = $member->memberStatistic->package_money;

        // because $lastDayPackageMoney + $intoPackageMoney - $outPackageMoney = $nowPackageMoney
        $lastDayPackageMoney = $nowPackageMoney + $outPackageMoney - $intoPackageMoney;
        return $lastDayPackageMoney;
    }
} 