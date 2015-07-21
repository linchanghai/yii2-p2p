<?php
use yii\helpers\Url;

/** @var \yii\web\View $this */
/** @var \p2p\recharge\models\RechargeRecord $model */
?>

    <div class="containerMain recharge">
        <ul class="clearFix rechargeTitle">
            <li><a class="active" href="#">网银支付</a></li>
        </ul>
        <div class="rechargeContainer rechargeSucceed">
            <h3>
                <i class="glyphicon glyphicon-ok fs18 mr10 themeColor"></i>您的账户已成功充值<?= $model->money; ?>元!
            </h3>
            <dl class="clearFix mt10 rechargeOptions">
                <dd class="fl ml20">
                    您可以选择: <a href="<?= Url::to(['/member/member/index']) ?>" class="ml20 themeColor">查看资产总额</a><a href="<?= Url::to(['/project/project/list']) ?>" class="ml10 themeColor">购买理财</a>
                </dd>
            </dl>
        </div>
    </div>

