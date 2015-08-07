<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\LinkPager;

?>

<div class="containerMain">
    <ul class="clearFix rechargeTitle">
        <li><a href="<?= Url::to(['/member/member-coupon/bonus-view']) ?>">红包券</a></li>
        <li><a href="<?= Url::to(['/member/member-coupon/cash-view']) ?>">现金券</a></li>
        <li><a class="active" href="<?= Url::to(['/member/member-coupon/annual-view']) ?>">年化券</a></li>
    </ul>
    <div class="backGrey p20 fundsRecords">
        <div class="clearFix mt10 filterLine">
            <label>状态筛选:</label>
            <?= Html::a('全部', ['/member/member-coupon/annual-view'], ['class' => (Yii::$app->request->get('status') == null) ? 'active' : '']) ?>
            <?= Html::a('已使用', ['/member/member-coupon/annual-view', 'status' => 1], ['class' => Yii::$app->request->get('status') ? 'active' : '']) ?>
            <?= Html::a('未使用', ['/member/member-coupon/annual-view', 'status' => 0], ['class' => (Yii::$app->request->get('status') == '0') ? 'active' : '']) ?>
        </div>
        <table class="table table-bordered textCenter mt20 tabContent">
            <thead>
            <tr>
                <th>编号</th>
                <th>利率(%)</th>
                <th>使用日</th>
                <th>到期日</th>
            </tr>
            </thead>
            <tbody>
            <?php
            if (isset($models) && $models) {
                foreach ($models as $model) {
                    ?>
                    <tr>
                        <td><?= $model->member_coupon_id ?></td>
                        <td><?= $model->value ?></td>
                        <td><?= date('Y-m-d H:i:s', $model->expire_date) ?></td>
                        <td><?= ($model->used_time == 0) ? '未使用' : date('Y-m-d H:i:s', $model->used_time) ?></td>
                    </tr>
                <?php }
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
            <?= LinkPager::widget(['pagination' => $page,]); ?>
        </div>
    </div>
</div>