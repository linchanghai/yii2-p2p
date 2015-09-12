<?php
use kartik\helpers\Html;
use yii\widgets\LinkPager;

$js = <<<JS
$('.fundsRecords').on('click', '.get-repayment', function() {
    $('.repaymentMoney').load($(this).data('url'));
    $('#repaymentModal').modal();
});
JS;
$this->registerJs($js);
?>


<div class="modal fade" id="repaymentModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">还款记录</h4>
            </div>
            <div class="modal-body">
                <div class="mt20 repaymentMoney">
                </div>
            </div>
        </div>
    </div>
</div>

<div class="containerMain">
    <ul class="clearFix rechargeTitle tabs">
        <li><a class="active" href="#">投资项目</a></li>
        <li><a href="#">认购债券</a></li>
    </ul>

    <div class="backGrey p20 fundsRecords">
        <div class="clearFix filterLine">
            <label>状态筛选:</label>
            <?= Html::a('全部', ['/project/project-invest/grid-view'], ['class' => (Yii::$app->request->get('status') == null) ? 'active' : '']) ?>
            <?= Html::a('还款中', ['/project/project-invest/grid-view', 'status' => 1], ['class' => (Yii::$app->request->get('status') == '1') ? 'active' : '']) ?>
            <?= Html::a('已完成', ['/project/project-invest/grid-view', 'status' => 2], ['class' => (Yii::$app->request->get('status') == '2') ? 'active' : '']) ?>

            <a href="#">转让中</a>
        </div>
        <table class="table table-bordered textCenter mt20 tabContent">
            <thead>
            <tr>
                <th>编号</th>
                <th>年化收益率</th>
                <th>金额(元)</th>
                <th>投资日</th>
                <th>到期日</th>
                <th>利息(元)</th>
                <th>状态</th>
                <th>操作</th>
            </tr>
            </thead>
            <tbody>
            <?php
            if (isset($models) && $models) {
                $status = [1 => '还款中', 2 => '已完成'];
                /** @var \p2p\project\models\ProjectInvest $model */
                foreach ($models as $model) {
                    ?>
                    <tr>
                        <td><?= $model->project_id ?></td>
                        <td><?= $model->rate ?></td>
                        <td><?= $model->invest_money ?></td>
                        <td><?= date('Y-m-d H:i:s', $model->create_time) ?></td>
                        <td><?= date('Y-m-d H:i:s', $model->project->repayment_date) ?></td>
                        <td><?= $model->interest_money ?></td>
                        <td><?= $status[$model->status] ?></td>
                        <td><?= \yii\helpers\Html::button('查看还款记录', ['class' => 'get-repayment', 'data-url' => \yii\helpers\Url::to(['project-invest/repayment-list', 'invest_id' => $model->project_invest_id])]) ?></td>
                    </tr>
                <?php
                }
            } else {
                ?>
                <tr>
                    <td colspan=10>
                        <div class="tableNoInfo">
                            <p class="p20">
                                <i class="glyphicon glyphicon-info-sign secondColor"></i> 暂无数据
                            </p>
                        </div>
                    </td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
        <div class="mt20 textCenter">
            <?= LinkPager::widget(['pagination' => $pagination]);
            ?>
        </div>
    </div>
</div>