<?php
/**
 * @link http://www.yincart.com/
 * @copyright Copyright (c) 2014 Yincart
 * @license http://www.yincart.com/license/
 */

use kiwi\Kiwi;
use yii\widgets\ActiveForm;
use yii\helpers\Html;
use yii\helpers\Url;

/** @var \p2p\withdraw\forms\WithdrawForm $model */
/** @var \core\member\models\MemberStatistic $memberStatistic */

$form = ActiveForm::begin();

?>
<div class="containerMain">
    <ul class="clearFix rechargeTitle">
        <li><a class="active" href="#">提现申请</a></li>
        <li><a href="<?= Url::to(['/withdraw/withdraw/withdraw-list']) ?>">提现记录</a></li>
    </ul>
    <br>
    <ul class="mt10 rechargeArea">
        <li class="mt10">
            <?= $form->field($model, 'canWithdrawMoney')->textInput([
                'class' => 'formControl mr16',
                'value' => $memberStatistic->account_money,
                'readonly' => true
            ])->label(null, ['style' => 'width:83px']); ?>
        </li>
        <li class="mt10">
            <?= $form->field($model, 'withdrawMoney')->textInput([
                'class' => 'formControl mr16'
            ])->label(null, ['style' => 'width:83px']); ?>
        </li>
        <li class="mt10">
            <?= $form->field($model, 'withdrawFee')->textInput([
                'class' => 'formControl mr16',
                'value' => 10
            ])->label(null, ['style' => 'width:83px']); ?>
        </li>
        <li class="mt10">
            <label class="invisible mr16">提现</label>
            <?= Html::submitButton('申请提现', ['class' => 'mt10 btn regularBtn themeBtn']) ?>
        </li>
    </ul>
    <?php
    //    echo $form->field($model, 'withdrawMoney');
    //    echo $form->field($model, 'canWithdrawMoney')->textInput(['value' => $memberStatistic->account_money, 'readonly' => true]);
    //    echo $form->field($model, 'withdrawFee')->textInput(['value' => 10]);
    //
    //    echo Html::submitButton('申请提现');

    $form->end();
    ?>
</div>
