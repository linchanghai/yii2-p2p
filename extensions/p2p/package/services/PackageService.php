<?php
/**
 * @link http://www.yincart.com/
 * @copyright Copyright (c) 2014 Yincart
 * @license http://www.yincart.com/license/
 */

namespace p2p\package;


use kiwi\base\Service;
use kiwi\Kiwi;

class PackageService extends Service
{
    public function income($money)
    {
        $packageRecord = Kiwi::getPackageRecord();
        $packageRecord->exchange_cash = $money;
        $packageRecord->type = $packageRecord::TYPE_INCOME;
        $packageRecord->save();

        $accountMoneyRecord = Kiwi::getStatisticChangeRecord();
        $accountMoneyRecord->value = -$money;
        $accountMoneyRecord->type = $accountMoneyRecord::TYPE_ACCOUNT_TO_PACKAGE;
        $accountMoneyRecord->link_id = $packageRecord->package_record_id;
        $accountMoneyRecord->save();

        $packageMoneyRecord = Kiwi::getStatisticChangeRecord();
        $packageMoneyRecord->value = $money;
        $packageMoneyRecord->type = $accountMoneyRecord::TYPE_PACKAGE_FROM_ACCOUNT;
        $packageMoneyRecord->link_id = $packageRecord->package_record_id;
        $packageMoneyRecord->save();
    }

    public function outgo($money)
    {

    }

    public function getInterest($money)
    {

    }
} 