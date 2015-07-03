<?php
/**
 * Created by PhpStorm.
 * User: LCH
 * Date: 2015/7/2
 * Time: 10:56
 */

/** @var \p2p\project\models\ProjectInvest $InvestPrepareForm */
$projectRepayments = $InvestPrepareForm->projectRepayments;
?>
<p>投资金额：<?= $InvestPrepareForm->invest_money; ?></p>
<p>年化收益：<?= $InvestPrepareForm->rate; ?>%</p>
<p>可获得收益：<?= $InvestPrepareForm->interest_money; ?></p>
<?php
/** @var \p2p\project\models\ProjectRepayment $projectRepayment */
foreach($projectRepayments as $projectRepayment) {
    ?>
    <p>付息时间：<?= date('Y-h-d', $projectRepayment->repayment_date); ?></p>
    <p>支付利息：<?= $projectRepayment->interest_money; ?></p>
<?php } ?>