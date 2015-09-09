<?php
/**
 * Created by PhpStorm.
 * User: LCH
 * Date: 2015/7/18
 * Time: 16:06
 */

use yii\helpers\Url;
use yii\widgets\LinkPager;

?>
<div class="containerMain fundsFlow">
    <div class="itemTitle">
        资金流水记录
    </div>
    <div class="fundsFlowContent p20">
        <div class="clearFix mt10 filterLine">
            <label>时间范围:</label>
            <a <?= Yii::$app->request->get('date') ? null : 'class="active"' ?>
                href="<?= Url::to(array_merge(Yii::$app->request->queryParams, [
                    '/member/statistic-change/statistic-list',
                    'date' => 0
                ])) ?>">全部</a>
            <a <?= Yii::$app->request->get('date') == 1 ? 'class="active"' : null ?>
                href="<?= Url::to(array_merge(Yii::$app->request->queryParams, [
                    '/member/statistic-change/statistic-list',
                    'date' => 1
                ])) ?>">1个月</a>
            <a <?= Yii::$app->request->get('date') == 2 ? 'class="active"' : null ?>
                href="<?= Url::to(array_merge(Yii::$app->request->queryParams, [
                    '/member/statistic-change/statistic-list',
                    'date' => 2
                ])) ?>">2个月</a>
            <a <?= Yii::$app->request->get('date') == 3 ? 'class="active"' : null ?>
                href="<?= Url::to(array_merge(Yii::$app->request->queryParams, [
                    '/member/statistic-change/statistic-list',
                    'date' => 3
                ])) ?>">3个月</a>
            <span class="fl">从</span>
            <input type="text" placeholder="请选择开始时间" class="fl datePicker">
            <span class="fl">到</span>
            <input type="text" placeholder="请选择截止时间" class="fl datePicker">
        </div>
        <div class="clearFix mt10 filterLine">
            <label>项目收益:</label>
            <a <?= Yii::$app->request->get('type') ? null : 'class="active"' ?>
                href="<?= Url::to(array_merge(Yii::$app->request->queryParams, [
                    '/member/statistic-change/statistic-list',
                    'type' => 0
                ])) ?>">全部</a>
            <a <?= Yii::$app->request->get('type') == 'recharge' ? 'class="active"' : null ?>
                href="<?= Url::to(array_merge(Yii::$app->request->queryParams, [
                    '/member/statistic-change/statistic-list',
                    'type' => 'recharge'
                ])) ?>">充值</a>
            <a <?= Yii::$app->request->get('type') == 'withdraw' ? 'class="active"' : null ?>
                href="<?= Url::to(array_merge(Yii::$app->request->queryParams, [
                    '/member/statistic-change/statistic-list',
                    'type' => 'withdraw'
                ])) ?>">提现</a>
            <a <?= Yii::$app->request->get('type') == 'invest' ? 'class="active"' : null ?>
                href="<?= Url::to(array_merge(Yii::$app->request->queryParams, [
                    '/member/statistic-change/statistic-list',
                    'type' => 'invest'
                ])) ?>">投资</a>
            <a <?= Yii::$app->request->get('type') == 'repayment' ? 'class="active"' : null ?>
                href="<?= Url::to(array_merge(Yii::$app->request->queryParams, [
                    '/member/statistic-change/statistic-list',
                    'type' => 'repayment'
                ])) ?>">回收</a>
            <a <?= Yii::$app->request->get('type') == 'transfer' ? 'class="active"' : null ?>
                href="<?= Url::to(array_merge(Yii::$app->request->queryParams, [
                    '/member/statistic-change/statistic-list',
                    'type' => 'transfer'
                ])) ?>">转让债券</a>
        </div>
        <table class="table table-bordered textCenter mt20">
            <thead>
            <tr>
                <th>交易时间</th>
                <th>交易类型</th>
                <th>交易金额(元)</th>
                <th>账户金额(元)</th>
                <th>备注</th>
            </tr>
            </thead>
            <tbody>
            <?php
            if (isset($models) && $models) {
                /** @var \core\member\models\StatisticChangeRecord $model */
                foreach ($models as $model) {
                    echo '<tr>';
                    echo '<td>' . date('Y-m-d H:i:s', $model->create_time) . '</td>';
                    echo '<td>' . $model->type . '</td>';
                    echo '<td>' . $model->value . '</td>';
                    echo '<td>' . $model->result . '</td>';
                    echo '<td>' . $model->note . '</td>';
                    echo '</tr>';
                }
            } else {
                ?>
                <tr>
                    <td colspan=10>
                        <div class="tableNoInfo">
                            <i class="glyphicon glyphicon-info-sign secondColor"></i> 暂无数据
                            <p>
                                <?php if (Yii::$app->request->getQueryParam('type') == 'recharge') { ?>
                                    <a href="<?= Url::to(['/recharge/recharge/recharge']) ?>"
                                       class="mt20 btn regularBtn">立即充值</a>
                                <?php } else if (Yii::$app->request->getQueryParam('type') == 'withdraw') { ?>
                                    <a href="<?= Url::to(['/withdraw/withdraw/withdraw']) ?>"
                                       class="mt20 btn regularBtn">立即提现</a>
                                <?php } else if (Yii::$app->request->getQueryParam('type') == 'invest') { ?>
                                    <a href="<?= Url::to(['/project/project/list']) ?>"
                                       class="mt20 btn regularBtn">立即投资</a>
                                <?php } ?>
                            </p>
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