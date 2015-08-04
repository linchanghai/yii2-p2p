<?php
/**
 * @link http://www.yincart.com/
 * @copyright Copyright (c) 2014 Yincart
 * @license http://www.yincart.com/license/
 */

use yii\helpers\Url;
/** @var \yii\web\View $this */

$js = <<<JS
if (!$('.autoPackage').data('is-auto')) {
    $(".switch").toggleClass("switchToggle");
}
$('.autoPackage').on('click', function() {
    var isOn = $(this).find('.switch').hasClass('switchToggle') ? 1 : 0;
    $.post($(this).data('url'), {isAuto:isOn}, function(response) {
        if (!response.status) {
            $(".switch").toggleClass("switchToggle");
        }
    }, 'json');
});
JS;
$this->registerJs($js);


/** @var \core\member\models\Member $member */
$member = Yii::$app->user->identity;
$memberStatistic = $member->memberStatistic;
$memberStatus = $member->memberStatus;
$totalMoney = $memberStatistic->account_money + $memberStatistic->freezon_money + $memberStatistic->package_money
    + $memberStatistic->collect_principal + $memberStatistic->collect_interest;
?>
<div class="containerMain accountCenter">
    <ul class="backGrey clearFix iAccount">
        <li>
            <h3><?=Yii::$app->user->identity->username?></h3>
            <div class="mt10 showSecurity">
                <a class="glyphicon glyphicon-phone <?= $memberStatus->mobile_status ? 'secondColor':''?>" href="<?= Url::to(['/member/member/bind-phone'])?>" title="手机验证"></a>
                <a class="glyphicon glyphicon-user <?= $memberStatus->id_card_status ? 'secondColor':''?>" href="<?= Url::to(['/member/member/save-real-name'])?>" title="身份验证"></a>
                <a class="glyphicon glyphicon-lock" href="#" title="安全验证"></a>
                <a class="glyphicon glyphicon-envelope <?= $memberStatus->email_status ? 'secondColor':''?>" href="<?= Url::to(['/member/member/member-info'])?>" title="邮箱验证"></a>
            </div>
            <?php
            $safetyLevel = [0 => '低', 1 => '中', 2 => '高', 3 => '', 4 => '硬'];
            $safetyValue = $memberStatus->mobile_status + $memberStatus->id_card_status + $memberStatus->email_status;
            ?>
            <div class="progress mt10">
                <div class="progress-bar progress-bar-striped secondBack" style="width: <?= $safetyValue / 4 * 100 ?>%;"></div>
            </div>
            <div class="mt10">
                安全等级: <?= $safetyLevel[$safetyValue] ?> <a class="secondColor" href="<?= Url::to('/member/member/member-info') ?>">(立即提升)</a>
            </div>
        </li>
        <li>
            <h3 class="col666">累计收益 <span class="fs12 showTips" title="投资人在钻点累计获得的收益总额(扣除折让金、罚息等)">?</span></h3>
            <p><?= $memberStatistic->project_earning+$memberStatistic->package_earning?>元</p>
            <h3 class="col666 mt10">可用余额 <span class="fs12 showTips" title="投资人在钻点累计获得的收益总额(扣除折让金、罚息等)">?</span></h3>
            <p><?= $memberStatistic->account_money?>元</p>
        </li>
        <li>
            <div class="clearFix">
                <img class="fl" width="45" height="66" src="/images/wallet.png" alt="">
                <div class="fl ml20">
                    <p class="mb20">钻点钱包</p>
                    <div class="switchWrap autoPackage" data-url="<?= Url::to(['/package/package/auto']) ?>" data-is-auto="<?= $memberStatistic->is_auto_into ?>">
                        <div class="switch clearFix">
                            <span class="switch-item switch-left">ON</span>
                            <span class="switch-middle">&nbsp;</span>
                            <span class="switch-item switch-right">OFF</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="mt10">开启余额自动转入钻点钱包</div>
        </li>
        <li class="lastNoBorder">
            <a href="<?= Url::to(['/recharge/recharge/recharge'])?>" class="btn themeBtn regularBtn largeBtn">充值</a>
        </li>
    </ul>
    <div class="mt20 p20 backGrey accountOverview clearFix">
        <div class="fl displayTable accountOverviewLeft">
            <p class="disTab">
                <span>账户总金额:</span>
                <br>
                <span><?= $totalMoney?>元</span>
                <br>
                <span>累计充值金额: 0.00元</span>
            </p>
        </div>
        <div class="fl accountOverviewRight">
            <ul class="clearFix accountOverviewUp">
                <li>
                    <p class="disTab">
                        <span>钻点钱包金额:</span>
                        <br>
                        <span><?=  $memberStatistic->package_money?>元</span>
                        <br>
                        <span>年化收益 <?= Yii::$app->setting->packageRate ?>% <a href="<?= Url::to(['/package/package/into']) ?>" class="secondColor">转入</a> <a href="<?= Url::to(['/package/package/out']) ?>" class="secondColor">转出</a></span>
                    </p>
                </li>
                <li>
                    <p class="disTab">
                        <span>投资中金额:</span>
                        <br>
                        <span><?= $memberStatistic->investingMoney ?> 元</span>
                        <br>
                        <span>累计收益 <?= $memberStatistic->project_earning?> 元</span>
                    </p>
                </li>
                <li class="lastNoBorder">
                    <p class="disTab">
                        <span>账户余额:</span>
                        <br>
                        <span><?= $memberStatistic->account_money?>元</span>
                        <br>
                    </p>
                </li>
            </ul>
            <div class="pt20 clearFix accountOverviewDown">
                <div class="fl">
                    <p class="disTab">
                        <span>累计奖金:</span>
                        <br>
                        <span>0.00元</span>
                        <br>
                        <span>红包: <?= $memberStatistic->bonus?>元 现金券: 0.00元</span>
                    </p>
                </div>
                <div class="fl">
                    <p class="disTab">
                        <span>奖励组成:</span>
                        <br>
                        <span class="ml20">向好友推荐拿返利红包</span>
                        <br>
                        <span class="ml20">活动奖励: 元 红包</span>
                        <br>
                        <span class="ml20">积分兑换: 张现金券</span>
                    </p>
                </div>
            </div>
        </div>
    </div>
    <div class="accountInvest mt20 backGrey">
        <div class="accountInvestTitle clearFix">
            <div class="fr">
                当前投资中的项目: <?= \kiwi\Kiwi::getProjectInvest()->investingProjectCount ?>
            </div>
            累计收益: <?= $memberStatistic->project_earning?> 元
        </div>
        <div class="accountInvestContainer">
            <div class="textRight searchTypeWrap">
                <label class="searchType" for="search1">
                    <input class="prt2" type="checkbox" name="searchType" id="search1">一个月以内
                </label>
                <label class="searchType" for="search2">
                    <input class="prt2" type="checkbox" name="searchType" id="search2">一个季度以内
                </label>
                <label class="searchType" for="search3">
                    <input class="prt2" type="checkbox" name="searchType" id="search3">一年以内
                </label>
                <label class="searchType" for="search4">
                    <input class="prt2" type="checkbox" name="searchType" id="search4">全部
                </label>
            </div>
            <table class="table">

            </table>
        </div>
    </div>
</div>