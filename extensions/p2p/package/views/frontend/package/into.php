<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

$member = Yii::$app->user->identity;
$memberStatistic = $member->memberStatistic;
?>
<div class="containerMain">
    <ul class="clearFix rechargeTitle">
        <li><a href="<?= Url::to(['/package/package/index']) ?>">钻点钱包</a></li>
        <li><a class="active" href="<?= Url::to(['/package/package/into']) ?>">转入</a></li>
        <li><a href="<?= Url::to(['/package/package/out']) ?>">转出</a></li>
    </ul>
    <div class="backGrey myWalletArea">
        <div class="itemTitle">
            转入到钻点钱包
        </div>
        <ul class="p20 clearFix myWalletIn">
           <li>
                <h3 class="mt20">钻点钱包资金</h3>
                <div class="mt20"><?= $memberStatistic->package_money ?>元</div>
           </li>
            <li>
                <h3 class="mt20">累计总收益</h3>
                <div class="mt20"><?= $memberStatistic->package_earning ?>元</div>
            </li>
            <li class="lastNoBorder textCenter">
                <h3 class="mt20">账户余额: <span id="myMoney"><?= $memberStatistic->account_money ?></span>元</h3>
                <a href="<?= Url::to(['/recharge/recharge/recharge']) ?>" class="mt20 btn regularBtn">充值</a>
            </li>
        </ul>
    </div>
    <?php $form = ActiveForm::begin(['id' => 'walletInForm', 'options' => ['class' => 'p20 backGrey myWalletNow']]) ?>
        <div class="clearFix">
            <div class="fl myWalletOutLeft">
                <label for="">钻点钱包年华收益率: </label>
                <span class="themeColor"><span id="package-rate"><?= \kiwi\Kiwi::getSettingModel()->P2P_package_packageRate ?></span>%</span>
            </div>
        </div>
        <div class="clearFix mt20">
            <?= $form->field($model, 'intoMoney', ['options' => ['class' => 'fl myWalletOutLeft'], 'inputOptions' => ['id' => 'myWalletNumber', 'class' => 'ml10 formControl', 'placeholder' => '金额为大于1的整数']]) ?>
            <div class="fl ml20">
                一年收益额约: <span id="willBe">0.00</span>元
            </div>
        </div>
        <div class="clearFix mt20 errorColor <?= $model->hasErrors('intoMoney') ? '' : 'hide' ?>">
            <div class="fl myWalletOutLeft">
                <label></label>
                <span>转入金额不正确</span>
            </div>
        </div>
        <div class="clearFix mt20">
            <div class="fl myWalletOutLeft">
                <label></label>
                    <input type="checkbox" class="prt2" checked disabled />
                    同意 <a class="secondColor" href="#"><<钻点钱包服务协议>></a>
            </div>
        </div>
        <div class="clearFix mt20">
            <div class="fl myWalletOutLeft">
                <label></label>
                <button type="submit" class="btn regularBtn">确认转入</button>
            </div>
        </div>
    <?php $form->end() ?>
</div>