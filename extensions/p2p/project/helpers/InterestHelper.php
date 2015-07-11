<?php
/**
 * Created by PhpStorm.
 * User: LCH
 * Date: 2015/6/22
 * Time: 20:35
 */

namespace p2p\project\helpers;


use kiwi\helpers\ArrayHelper;


class InterestHelper
{
    /**
     * @param integer|float $money the invest money
     * @param float $rate the rate of year
     * @param integer $startDate start get interest date
     * @param integer $endDate get all money and interest date
     * @param integer $repaymentDay get interest day of every month
     * @return array the invest info
     */
    public static function calculateInterest($money, $rate, $startDate, $endDate, $repaymentDay)
    {
        $invest = [];
        $repayments = [];

        $rate = $rate / 100;

        $repaymentDate = strtotime(date('Y-m-' . $repaymentDay));
        while ($repaymentDate < $endDate) {
            $days = ceil(($repaymentDate - $startDate) / 3600 / 24);
            $interestMoney = $money * $rate / 365 * $days;
            $principalMoney = 0;
            $repayments[] = [
                'interestMoney' => $interestMoney,
                'principalMoney' => $principalMoney,
                'repaymentDate' => $repaymentDate
            ];

            $startDate = $repaymentDate;
            $repaymentDate = strtotime('+1 month', $repaymentDate);
        }

        $repaymentDate = $endDate;
        $days = ceil(($repaymentDate - $startDate) / 3600 / 24);
        $interestMoney =$money* $rate / 365 * $days;
        $principalMoney = $money;
        $repayments[] = [
            'interestMoney' => $interestMoney,
            'principalMoney' => $principalMoney,
            'repaymentDate' => $repaymentDate
        ];

        $totalInterestMoney = array_sum(ArrayHelper::getColumn($repayments, 'interestMoney'));
        return [$totalInterestMoney, $repayments];
    }
}