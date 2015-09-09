<?php
/**
 * Created by PhpStorm.
 * Author: changhai.lin<1079140464@qq.com>
 * Date: 2015/7/31
 * Time: 11:20
 */

use yii\helpers\Url;
use \yii\widgets\LinkPager;

?>
<div class="containerMain">
    <ul class="clearFix rechargeTitle tabs">
        <li><a class="active" href="#">可转让项目</a></li>
        <li><a href="<?= Url::to(['/transfer/transfer/pending']) ?>">转让中项目</a></li>
        <li><a href="<?= Url::to(['/transfer/transfer/completed']) ?>">已经转让项目</a></li>
    </ul>
    <div class="backGrey p20 fundsRecords">
        <table class="table table-bordered textCenter mt20 tabContent">
            <thead>
            <tr>
                <th>项目名称</th>
                <th>转让金额(元)</th>
                <th>年化收益率</th>
                <th>投资日</th>
                <th>到期日</th>
                <th>已付利息(元)</th>
                <th>未付利息(元)</th>
                <th>操作</th>
            </tr>
            </thead>
            <tbody>
            <?php
            if (isset($models) && $models) {
                /** @var \p2p\project\models\ProjectInvest $model */
                foreach ($models as $model) {
                    echo '<tr>';
                    echo '<td>' . $model->project->project_name . '</td>';
                    echo '<td>' . $model->project->project_name . '</td>';
                    echo '<td>' . $model->rate . '</td>';
                    echo '<td>' . date('Y-m-d', $model->create_time) . '</td>';
                    echo '<td>' . date('Y-m-d', $model->project->repayment_date) . '</td>';
                    echo '<td>' . $model->rate . '</td>';
                    echo '<td>' . $model->rate . '</td>';
                    echo '<td><a href="' . Url::to(['/transfer/transfer/create', 'project_invest_id' => $model->project_invest_id]) . '" class="secondColor">转让</a></td>';
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