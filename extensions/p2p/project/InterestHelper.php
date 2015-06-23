<?php
/**
 * Created by PhpStorm.
 * User: LCH
 * Date: 2015/6/22
 * Time: 20:35
 */

namespace p2p\project;


use kiwi\helpers\ArrayHelper;


class InterestHelper
{
    /**
     * @param $money the invest money
     * @param $rate the rate of year
     * @param $startDate start get interest date
     * @param $endDate get all money and interest date
     * @param $repaymentDay get interest day of every month
     * @return array the invest info
     */
    public static function calculateInterest($money, $rate, $startDate, $endDate, $repaymentDay)
    {
        $invest = [];
        $repayments = [];

        $repaymentDate = strtotime(date('Y-m-' . $repaymentDay));
        while ($repaymentDate < $endDate) {
            $days = ($repaymentDate - $startDate) / 3600 / 24;
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
        $days = ($repaymentDate - $startDate) / 3600 / 24;
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