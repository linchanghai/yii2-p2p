<?php
$this->registerCssFile(Yii::$app->urlManager->baseUrl . '/css/invest.min.css', ['depends' => [\frontend\assets\AppAsset::className()]]);

$this->registerJsFile(Yii::$app->urlManager->baseUrl . '/js/invest.js', ['depends' => [\frontend\assets\AppAsset::className()]]);

?>

<div class="backWhite pt10">
    <div class="container backGrey p20 mt20 afterInvest textCenter">
        <p class="fs18"><i class="glyphicon glyphicon-yen themeColor fs20"></i>恭喜您,投资<?= $projectModel->project->project_name ?>项目成功,投资金额 <?= $projectModel->invest_money?> 元</p>
        <p class="mt20">您可以在 <a href="#" class="themeColor">投资记录</a>中查看详情,或者选择 <a href="#" class="themeColor">继续投资</a></p>
        <p class="mt20 col999">小提示: 在投资结束后,您的资金会自动转入您的个人用户钱包中,随时提取。同时,我们也会以短信形式提醒您</p>
    </div>
    <div class="container backGrey p20 mt20 afterInvest">
        <div class="fs18">
            温馨提示:
        </div>
        <div class="mt20 clearFix afterInvestArea">
            <span class="fl"><i class="glyphicon glyphicon-open themeColor fs16"></i>恭喜您获得5个会员成长值</span><a href="#" class="themeColor fr">什么是会员成长值?</a>
        </div>
        <div class="mt20 clearFix afterInvestArea">
            <span class="fl"><i class="glyphicon glyphicon-ok-sign themeColor fs16"></i>恭喜您获得10个钻点积分</span><a href="#" class="themeColor fr">积分兑换?</a>
        </div>
    </div>
</div>