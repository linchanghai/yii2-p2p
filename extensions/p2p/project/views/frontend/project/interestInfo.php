<?php
/**
 * Created by PhpStorm.
 * User: LCH
 * Date: 2015/7/6
 * Time: 10:24
 */

/** @var \p2p\project\models\ProjectInvest $invest */
$projectRepayments = $invest->projectRepayments;
?>

<table class="table table-bordered">
    <thead>
    <tr>
        <th>年化收益率: <?= $invest->rate; ?>%</th>
        <th>可获得收益: <?= floor($invest->interest_money * 100) / 100; ?>元</th>
    </tr>
    </thead>
    <tbody>
    <?php
    /** @var \p2p\project\models\ProjectRepayment $projectRepayment */
    foreach ($projectRepayments as $projectRepayment) {
        ?>
        <tr>
            <td>付息时间: <?= date('Y-m-d', $projectRepayment->repayment_date); ?></td>
            <td>支付利息: <?= floor($projectRepayment->interest_money * 100) / 100; ?>元</td>
        </tr>
    <?php } ?>
    </tbody>
</table>