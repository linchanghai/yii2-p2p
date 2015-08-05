<?php
/**
 * Created by PhpStorm.
 * User: LCH
 * Date: 2015/7/18
 * Time: 14:28
 */

use yii\helpers\Url;

?>
<div class="containerMain">
    <ul class="clearFix rechargeTitle">
        <li><a href="<?= Url::to(['/withdraw/withdraw/withdraw']) ?>">提现申请</a></li>
        <li><a class="active" href="#">提现记录</a></li>
    </ul>
    <div class="backGrey p20 fundsRecords">
        <div class="clearFix mt10 filterLine">
            <label>时间范围:</label>
            <a class="active" href="#">全部</a>
            <a href="#">1个月</a>
            <a href="#">2个月</a>
            <a href="#">3个月</a>
        </div>
        <table class="table table-bordered textCenter mt20 tabContent">
            <thead>
            <tr>
                <th>时间</th>
                <th>金额(元)</th>
                <th>手续费(元)</th>
            </tr>
            </thead>
            <tbody>
            <?php
            /** @var \p2p\withdraw\models\WithdrawRecord $model */
            foreach ($models as $model) {
                echo '<tr>';
                echo '<td>' . date('Y-m-d H:i:s', $model->create_time) . '</td>';
                echo '<td>' . $model->money . '</td>';
                echo '<td>' . $model->counter_fee . '</td>';
                echo '</tr>';
            }
            ?>
            </tbody>
        </table>
    </div>
</div>