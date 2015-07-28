<?php
use yii\helpers\Url;
use yii\widgets\ActiveForm;

$member = Yii::$app->user->identity;
$memberStatistic = $member->memberStatistic;
?>
<div class="containerMain">
        <ul class="clearFix rechargeTitle">
            <li><a href="<?= Url::to(['/package/package/index']) ?>">钻点钱包</a></li>
            <li><a href="<?= Url::to(['/package/package/into']) ?>">转入</a></li>
            <li><a class="active" href="<?= Url::to(['/package/package/out']) ?>">转出</a></li>
        </ul>
        <div class="backGrey myWalletArea">
            <div class="itemTitle">
                转出到余额 <span class="warningColor ml20">免手续费</span>
            </div>
            <div class="clearFix p20 fs16 myWalletOut">
                <div class="clearFix">
                    <div class="fl myWalletOutLeft">
                        <label>可转钻点钱包额度:</label> <span id="myWalletOver"><?= $memberStatistic->package_money ?></span>元
                    </div>
                    <div class="fl ml20">
                        总收益: <?= $memberStatistic->package_earning ?>元
                    </div>
                </div>
                <?php $form = ActiveForm::begin(['id' => 'walletSubmit', 'options' => ['class' => 'mt20']]) ?>
                    <div class="clearFix">
                        <?= $form->field($model, 'outMoney', ['options' => ['class' => 'fl myWalletOutLeft'], 'inputOptions' => ['id' => 'myWalletNumber', 'class' => 'ml10 formControl']]) ?>
                        <div class="fl ml20 warningColor">
                            每人每天只有一次转出机会
                        </div>
                    </div>
                    <div class="mt20">
                        <div class="ml10 myWalletOutLeft errorColor <?= $model->hasErrors('outMoney') ? '' : 'hide' ?>">
                            <label></label>
                            转出金额不正确
                        </div>
                        <div class="mt10 myWalletOutLeft">
                            <label></label>
                            <button type="submit" class="btn regularBtn">确认转出</button>
                        </div>
                    </div>
                <?php $form->end() ?>
            </div>
        </div>
    </div>