<?php
/**
 * Created by PhpStorm.
 * Author: changhai.lin<1079140464@qq.com>
 * Date: 2015/8/1
 * Time: 14:50
 */

use yii\helpers\Url;
use yii\widgets\LinkPager;

?>
<div class="containerMain">
    <ul class="clearFix rechargeTitle">
        <li><a href="<?= Url::to(['/transfer/transfer/enable']) ?>">可转让项目</a></li>
        <li><a class="active" href="#">转让中项目</a></li>
        <li><a href="<?= Url::to(['/transfer/transfer/completed']) ?>">已经转让项目</a></li>
    </ul>
    <div class="backGrey p20 fundsRecords">
        <table class="table table-bordered textCenter mt20 tabContent">
            <thead>
            <tr>
                <th>项目名称</th>
                <th>转让金额(元)</th>
                <th>年化收益率</th>
                <th>折价率</th>
                <th>已完成转让</th>
                <th>已获得资金(元)</th>
                <th>已付服务费(元)</th>
                <th>截止时间</th>
                <th>操作</th>
            </tr>
            </thead>
            <tbody>
            <?php
            if (isset($models) && $models) {
                /** @var \p2p\transfer\models\ProjectInvestTransferApply $model */
                foreach ($models as $model) {
                    echo '<tr>';
                    echo '<td>' . $model->project->project_name . '</td>';
                    echo '<td>' . $model->total_invest_money . '</td>';
                    echo '<td>' . $model->projectInvest->rate . '</td>';
                    echo '<td>' . $model->discount_rate . '</td>';
                    echo '<td>' . $model->discount_rate . '</td>';
                    echo '<td>' . $model->discount_rate . '</td>';
                    echo '<td>' . $model->discount_rate . '</td>';
                    echo '<td>' . date('Y-m-d', $model->project->repayment_date) . '</td>';
                    echo '<td><a href="#" class="secondColor">查看</a></td>';
                    echo '</tr>';
                }
            } else {
                ?>
                <tr>
                    <td colspan=10>
                        <div class="tableNoInfo">
                            <i class="glyphicon glyphicon-info-sign secondColor"></i> 暂无数据
                        </div>
                    </td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
        <div class="mt20 textCenter">
            <?= LinkPager::widget(['pagination' => $pagination]) ?>
        </div>
    </div>
</div>