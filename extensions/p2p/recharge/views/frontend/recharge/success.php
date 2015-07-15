<?php
$this->registerCssFile(Yii::$app->urlManager->baseUrl . '/css/account.min.css', ['depends' => [\frontend\assets\AppAsset::className()]]);

$this->registerJsFile(Yii::$app->urlManager->baseUrl . '/js/account.js', ['depends' => [\frontend\assets\AppAsset::className()]]);

?>

    <div class="containerMain recharge">
        <ul class="clearFix rechargeTitle">
            <li><a class="active" href="#">网银支付</a></li>
        </ul>
        <div class="rechargeContainer rechargeSucceed">
            <h3>
                <i class="glyphicon glyphicon-ok fs18 mr10 themeColor"></i>您的账户已成功充值1000元!
            </h3>
            <dl class="clearFix mt10 rechargeOptions">
                <dd class="fl ml20">
                    您可以选择: <a href="#" class="ml20 themeColor">查看资产总额</a><a href="#" class="ml10 themeColor">购买理财</a>
                </dd>
            </dl>
        </div>
    </div>

