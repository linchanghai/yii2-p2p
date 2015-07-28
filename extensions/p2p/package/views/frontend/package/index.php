<?php
use yii\helpers\Url;
use yii\widgets\LinkPager;

/** @var yii\web\View $this */
/** @var yii\data\ActiveDataProvider $intoDataProvider */
/** @var yii\data\ActiveDataProvider $outDataProvider */

$member = Yii::$app->user->identity;
$memberStatistic = $member->memberStatistic;

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
?>
<div class="containerMain">
    <ul class="clearFix rechargeTitle">
        <li><a class="active" href="<?= Url::to(['/package/package/index']) ?>">钻点钱包</a></li>
        <li><a href="<?= Url::to(['/package/package/into']) ?>">转入</a></li>
        <li><a href="<?= Url::to(['/package/package/out']) ?>">转出</a></li>
    </ul>
    <div class="rechargeContainer clearFix p20 myWallet">
        <div class="walletInfoItem displayTable">
            <div class="disTab">
                <p>钻点钱包资金</p>

                <p class="mt10"><?= $memberStatistic->package_money ?>元</p>
            </div>
        </div>
        <div class="walletInfoItem displayTable">
            <div class="disTab">
                <p>累计收益</p>

                <p class="mt10"><?= $memberStatistic->package_earning ?>元</p>
            </div>
        </div>
        <div class="walletInfoRight">
            <div class="clearFix walletInfoRight1">
                <div class="fl">本金x.xx元</div>
                <div class="fl ml10">
                    余额自动转入钻点钱包
                </div>
                <div class="fl ml10">
                    <div class="switchWrap autoPackage" data-url="<?= Url::to(['/package/package/auto']) ?>" data-is-auto="<?= $memberStatistic->is_auto_into ?>">
                        <div class="switch clearFix">
                            <span class="switch-item switch-left">ON</span>
                            <span class="switch-middle">&nbsp;</span>
                            <span class="switch-item switch-right">OFF</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="clearFix mt10">
                <div class="fl mt10">收益x.xx元</div>
                <div class="fl ml10">
                    <a href="<?= Url::to(['/package/package/into']) ?>" class="fl btn regularBtn secondBack ml10">转入</a>
                    <a href="<?= Url::to(['/package/package/out']) ?>" class="fl btn regularBtn secondBack ml10">转出</a>
                </div>
            </div>

        </div>
    </div>
    <div class="mt20 backGrey myWalletArea">
        <ul class="clearFix myWalletAreaTap">
            <li class="active">转入</li>
            <li>转出</li>
        </ul>
        <div class="myWalletAreaDetail">
            <div class="myWalletSingle p20">
                <table class="table table-bordered textCenter">
                    <thead>
                    <tr>
                        <th>时间</th>
                        <th>金额</th>
                        <th>状态</th>
                        <th>操作</th>
                        <th>合同</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    /** @var \p2p\package\models\PackageRecord[] $models */
                    $models = $intoDataProvider->getModels();
                    foreach ($models as $model) {
                        ?>
                        <tr>
                            <td><?= date('Y-m-d H:i:s', $model->create_time) ?></td>
                            <td><?= $model->exchange_cash ?>元</td>
                            <td>成功</td>
                            <td>转入</td>
                            <td><a href="#">合同明细</a></td>
                        </tr>
                    <?php } ?>
                    </tbody>
                </table>
                <?php LinkPager::widget(['pagination' => $intoDataProvider->pagination]) ?>
            </div>
            <div class="myWalletSingle p20 hide">
                <table class="table table-bordered textCenter">
                    <thead>
                    <tr>
                        <th>时间</th>
                        <th>金额</th>
                        <th>状态</th>
                        <th>操作</th>
                        <th>合同</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php /** @var \p2p\package\models\PackageRecord[] $models */
                    $models = $outDataProvider->getModels();
                    foreach ($models as $model) {
                        ?>
                        <tr>
                            <td><?= date('Y-m-d H:i:s', $model->create_time) ?></td>
                            <td><?= $model->exchange_cash ?>元</td>
                            <td>成功</td>
                            <td>转出</td>
                            <td><a href="#">合同明细</a></td>
                        </tr>
                    <?php } ?>
                    </tbody>
                </table>
                <?php LinkPager::widget(['pagination' => $outDataProvider->pagination]) ?>
            </div>
        </div>
    </div>
</div>