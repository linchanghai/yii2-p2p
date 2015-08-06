<?php
/**
 * Created by PhpStorm.
 * User: LCH
 * Date: 2015/7/18
 * Time: 14:28
 */

use yii\helpers\Url;
use \yii\widgets\LinkPager;

?>
<div class="containerMain">
    <ul class="clearFix rechargeTitle">
        <li><a href="<?= Url::to(['/withdraw/withdraw/withdraw']) ?>">提现申请</a></li>
        <li><a class="active" href="#">提现记录</a></li>
    </ul>
    <div class="backGrey p20 fundsRecords">
        <div class="clearFix mt10 filterLine">
            <label>时间范围:</label>
            <a <?= Yii::$app->request->get('date') ? null : 'class="active"' ?>
                href="<?= Url::to(array_merge(\Yii::$app->request->queryParams, ['/withdraw/withdraw/withdraw-list', 'date' => 0])) ?>">全部</a>
            <a <?= Yii::$app->request->get('date') == 1 ? 'class="active"' : null ?>
                href="<?= Url::to(array_merge(\Yii::$app->request->queryParams, ['/withdraw/withdraw/withdraw-list', 'date' => 1])) ?>">一个月以内</a>
            <a <?= Yii::$app->request->get('date') == 2 ? 'class="active"' : null ?>href="<?= Url::to(array_merge(\Yii::$app->request->queryParams, ['/withdraw/withdraw/withdraw-list', 'date' => 2])) ?>">1-3个月</a>
            <a <?= Yii::$app->request->get('date') == 3 ? 'class="active"' : null ?>href="<?= Url::to(array_merge(\Yii::$app->request->queryParams, ['/withdraw/withdraw/withdraw-list', 'date' => 3])) ?>">3-6个月</a>
            <a <?= Yii::$app->request->get('date') == 4 ? 'class="active"' : null ?>href="<?= Url::to(array_merge(\Yii::$app->request->queryParams, ['/withdraw/withdraw/withdraw-list', 'date' => 4])) ?>">6个月以上</a>
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
            if (isset($models) && $models) {
                /** @var \p2p\withdraw\models\WithdrawRecord $model */
                foreach ($models as $model) {
                    echo '<tr>';
                    echo '<td>' . date('Y-m-d H:i:s', $model->create_time) . '</td>';
                    echo '<td>' . $model->money . '</td>';
                    echo '<td>' . $model->counter_fee . '</td>';
                    echo '</tr>';
                }
            } else {
                ?>
                <tr>
                    <td colspan=5>
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