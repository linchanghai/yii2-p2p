<?php
use kartik\helpers\Html;
?>

<table border="1">
    <tr>
        <th>1</th>
        <th>2</th>
        <th>3</th>
        <th>4</th>
        <th>5</th>
        <th>6</th>
        <th>7</th>
    </tr>
    <?php
    foreach ($models as $model) {
        ?>
        <tr>
            <td><?= $model->project_id ?></td>
            <td><?= $model->rate ?></td>
            <td><?= $model->invest_money ?></td>
            <td><?= $model->interest_money ?></td>
            <td><?= $model->create_time ?></td>
            <td><?= $model->actual_invest_money ?></td>
            <td><?= $model->actual_invest_money ?></td>
            <td><?= \yii\helpers\Html::button('查看付款记录',['class'=>'toInvest']) ?></td>
        </tr>
    <?php
    }
    ?>
</table>

<div class="modal fade" id="investModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">填写投资金额</h4>
            </div>
            <div class="modal-body">
                <?php \yii\widgets\Pjax::begin() ?>

                <?php \yii\widgets\Pjax::end() ?>
                <div class="mt20 investSingleMoney">

                </div>
            </div>
        </div>
    </div>
</div>