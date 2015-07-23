<?php

use frontend\assets\AppAsset;
use yii\helpers\Url;

/* @var $this \yii\web\View */
$this->beginContent('@app/views/layouts/main.php');

$this->registerCssFile('/css/account.min.css', ['depends' => [AppAsset::className()]]);
$this->registerCssFile('/css/invest.min.css', ['depends' => [AppAsset::className()]]);
$this->registerJsFile('/js/account.js', ['depends' => [AppAsset::className()]]);
?>

<div class="container twoContainer">
    <div class="containerSide accountSide" id="accountSide">
        <dl>
            <dt><a href="<?= Url::to(['/member/member/index']) ?>"><i class="glyphicon glyphicon-th-list fs16"></i>我的账户</a>
            </dt>
        </dl>
        <dl class="<?= in_array(Yii::$app->request->pathInfo, [
            'recharge/recharge/recharge',
            'recharge/recharge/recharge-list',
            'withdraw/withdraw/withdraw',
            'withdraw/withdraw/withdraw-list',
            'package/package-record/package-list',
            'package/package-record/into-list',
            'package/package-record/out-list',
            'member/statistic-change/statistic-list'
        ]) ? 'current' : '' ?>">
            <dt><a href="#"><i class="glyphicon glyphicon-hdd fs16"></i>资产管理</a></dt>
            <dd class="<?= in_array(Yii::$app->request->pathInfo, [
                'recharge/recharge/recharge',
                'recharge/recharge/recharge-list',
            ]) ? 'active' : '' ?>">
                <a href="<?= Url::to(['/recharge/recharge/recharge-list']) ?>">充值管理</a></dd>
            <dd class="<?= in_array(Yii::$app->request->pathInfo, [
                'withdraw/withdraw/withdraw',
                'withdraw/withdraw/withdraw-list'
            ]) ? 'active' : '' ?>">
                <a href="<?= Url::to(['/withdraw/withdraw/withdraw-list']) ?>">提现管理</a></dd>
            <dd class="<?= in_array(Yii::$app->request->pathInfo, [
                'package/package-record/package-list',
                'package/package-record/into-list',
                'package/package-record/out-list',
            ]) ? 'active' : '' ?>">
                <a href="<?= Url::to(['/package/package-record/package-list']) ?>">钻点钱包</a></dd>
            <dd class="<?= (Yii::$app->request->pathInfo == 'member/statistic-change/statistic-list') ? 'active' : '' ?>">
                <a href="<?= Url::to(['/member/statistic-change/statistic-list']) ?>">资金流水</a></dd>
        </dl>
        <dl>
            <dt><a href="#"><i class="glyphicon glyphicon-yen fs16"></i>理财管理</a></dt>
            <dd><a href="<?= Url::to(['/project/project-invest/grid-view']) ?>">投资记录</a></dd>
            <dd><a href="#">债券转让</a></dd>
            <dd><a href="#">资产统计</a></dd>
        </dl>
        <dl class="<?= in_array(Yii::$app->request->pathInfo, ['member/member/member-info', 'member/member/reset-password', 'message/message/my-message']) ? 'current' : '' ?>">
            <dt><a href="#"><i class="glyphicon glyphicon-user fs16"></i>个人信息</a></dt>
            <dd class="<?= in_array(Yii::$app->request->pathInfo, ['member/member/member-info']) ? 'active' : '' ?>"><a
                    href="<?= Url::to(['/member/member/member-info']) ?>">基本信息</a></dd>
            <dd class="<?= in_array(Yii::$app->request->pathInfo, ['member/member/reset-password']) ? 'active' : '' ?>">
                <a href="<?= Url::to(['/member/member/reset-password']) ?>">密码设置</a></dd>
            <dd class="<?= in_array(Yii::$app->request->pathInfo, ['message/message/my-message']) ? 'active' : '' ?>">
                <a href="<?= Url::to(['/message/message/my-message']) ?>">我的消息</a></dd>
        </dl>
        <dl class="<?= in_array(Yii::$app->request->pathInfo, ['member/member-coupon/bonus-view', 'member/member-coupon/annual-view', 'member/member-coupon/cash-view']) ? 'current' : '' ?>">
            <dt><a href="#"><i class="glyphicon glyphicon-sort fs16"></i>互动管理</a></dt>
            <dd class="<?= in_array(Yii::$app->request->pathInfo, ['member/member-coupon/bonus-view', 'member/member-coupon/annual-view', 'member/member-coupon/cash-view']) ? 'active' : '' ?>">
                <a href="<?= Url::to(['/member/member-coupon/bonus-view']) ?>">我的优惠券</a></dd>
            <dd><a href="#">邀请好友</a></dd>
        </dl>
    </div>
    <?= $content; ?>
</div>
<?php
$this->endContent();
?>
