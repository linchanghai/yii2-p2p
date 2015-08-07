<?php
use kartik\helpers\Html;
use \yii\widgets\LinkPager;

?>
<table class="table table-bordered textCenter mt20 tabContent">
    <thead>
    <tr>
        <th>编号</th>
        <th>应还本金(元)</th>
        <th>应还利息(元)</th>
        <th>还款时间</th>
        <th>状态</th>
    </tr>
    </thead>
    <tbody>
    <?php
    if (isset($models) && $models) {
        /** @var \p2p\project\models\ProjectRepayment $model */
        foreach ($models as $model) {
            ?>
            <tr>
                <td><?= $model->project_repayment_id ?></td>
                <td><?= $model->interest_money ?></td>
                <td><?= $model->invest_money ?></td>
                <td><?= date('Y-m-d H:i:s', $model->repayment_date) ?></td>
                <td><?= $model->status ? '已还款' : '未还款' ?></td>
            </tr>
        <?php
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
    ?>
    </tbody>
</table>
<div class="mt20 textCenter">
    <?= LinkPager::widget(['pagination' => $pagination]) ?>
</div>
