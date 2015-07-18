<?php
/**
 * @link http://www.yincart.com/
 * @copyright Copyright (c) 2014 Yincart
 * @license http://www.yincart.com/license/
 */

/** @var \yii\web\View $this */

/** @var \core\member\models\Member $member */
$member = Yii::$app->user->identity;
$memberStatistic = $member->memberStatistic;
$totalMoney = $memberStatistic->account_money + $memberStatistic->freezon_money + $memberStatistic->package_money
    + $memberStatistic->collect_principal + $memberStatistic->collect_interest;

echo '账户总资产：', $totalMoney, '<br />';
echo '账户余额: ', $memberStatistic->account_money, '<br />';
echo '冻结金额: ', $memberStatistic->freezon_money, '<br />';
echo '钱包余额: ', $memberStatistic->package_money, '<br />';
echo '钱包总收益: ', $memberStatistic->package_earning, '<br />';
echo '总投资金额: ', $memberStatistic->project_total_money, '<br />';
echo '总投资收益: ', $memberStatistic->project_earning, '<br />';
echo '待收本金: ', $memberStatistic->collect_principal, '<br />';
echo '待收利息: ', $memberStatistic->collect_interest, '<br />';