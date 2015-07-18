<?php
use yii\helpers\Url;

/* @var $this \yii\web\View */
$this->beginContent('@app/views/layouts/main.php');
?>
    <div class="container twoContainer">
        <div class="containerSide accountSide" id="accountSide">
            <dl>
                <dt><a href="#"><i class="glyphicon glyphicon-th-list fs16"></i>我的账户</a></dt>
            </dl>
            <dl class="<?= in_array(Yii::$app->request->pathInfo, ['recharge/recharge/recharge-list', 'withdraw/withdraw/withdraw-list']) ? 'current' : '' ?>">
                <dt><a href="#"><i class="glyphicon glyphicon-hdd fs16"></i>资产管理</a></dt>
                <dd class="<?= (Yii::$app->request->pathInfo == 'recharge/recharge/recharge-list') ? 'active' : '' ?>">
                    <a href="<?= Url::to(['/recharge/recharge/recharge-list']) ?>">充值管理</a></dd>
                <dd class="<?= (Yii::$app->request->pathInfo == 'withdraw/withdraw/withdraw-list') ? 'active' : '' ?>">
                    <a href="<?= Url::to(['/withdraw/withdraw/withdraw-list']) ?>">提现管理</a></dd>
                <dd><a href="#">理财管理</a></dd>
                <dd><a href="#">资金流水</a></dd>
            </dl>
            <dl>
                <dt><a href="#"><i class="glyphicon glyphicon-yen fs16"></i>理财管理</a></dt>
                <dd><a href="#">投资记录</a></dd>
                <dd><a href="#">债券转让</a></dd>
                <dd><a href="#">资产统计</a></dd>
            </dl>
            <dl>
                <dt><a href="#"><i class="glyphicon glyphicon-user fs16"></i>个人信息</a></dt>
                <dd><a href="#">基本信息</a></dd>
                <dd><a href="#">密码设置</a></dd>
                <dd><a href="#">我的消息</a></dd>
            </dl>
            <dl class="<?= in_array(Yii::$app->request->pathInfo, ['member/member-coupon/bonus-view']) ? 'current' : '' ?>">
                <dt><a href="#"><i class="glyphicon glyphicon-sort fs16"></i>互动管理</a></dt>
                <dd class="<?= (Yii::$app->request->pathInfo == 'member/member-coupon/bonus-view') ? 'active' : '' ?>">
                    <a href="<?= Url::to(['/member/member-coupon/bonus-view']) ?>">我的优惠券</a></dd>
                <dd><a href="#">邀请好友</a></dd>
            </dl>
        </div>
        <?= $content; ?>
    </div>
<?php
$this->endContent();
?>