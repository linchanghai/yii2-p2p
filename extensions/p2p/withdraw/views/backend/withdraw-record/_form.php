<?php

use yii\helpers\Html;
use kartik\widgets\ActiveForm;
use kiwi\Kiwi;

/* @var $this yii\web\View */
/* @var $model p2p\withdraw\models\WithdrawRecord */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="withdraw-record-form">

    <?php $form = ActiveForm::begin([
        'id' => 'withdraw-record-form-horizontal',
        'type' => ActiveForm::TYPE_HORIZONTAL,
        'formConfig' => ['labelSpan' => 2],
        'fullSpan' => 11,
        'disabled' => 'disabled'
    ]); ?>

    <?= $form->field($model, 'member_id')->textInput() ?>

    <?= $form->field($model, 'money')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'counter_fee')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'deposit_type')->textInput(['value' => Kiwi::getDataListModel()->withdrawType[$model->deposit_type]]) ?>

    <?php
    $withdrawClass = Kiwi::getWithdrawRecord();
    echo $form->field($model, 'first_verify_memo')->textarea([
        'maxlength' => 255,
        'disabled' => $model->status == $withdrawClass::STATUS_PENDING ? false : 'disabled'
    ]);
    if ($model->status != $withdrawClass::STATUS_PENDING) {
        if ($model->status == $withdrawClass::STATUS_FIRST_VERIFY_SUCCESS) {
            echo $form->field($model, 'status')->dropDownList(Kiwi::getDataListModel()->withdrawSecondVerifyStatus, ['disabled' => false]);
        }

        echo $form->field($model, 'second_verify_memo')->textarea([
            'maxlength' => 255,
            'disabled' => $model->status == $withdrawClass::STATUS_FIRST_VERIFY_SUCCESS ? false : 'disabled'
        ]);
    }
    ?>

    <?php
    $withdrawClass = Kiwi::getWithdrawRecordClass();
    if ($model->status == $withdrawClass::STATUS_PENDING || $model->status == $withdrawClass::STATUS_FIRST_VERIFY_SUCCESS) {
        ?>
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-9">
                <?= Html::submitButton($model->isNewRecord ? Yii::t('p2p_withdraw', 'Create') : Yii::t('p2p_withdraw', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
            </div>
        </div>
    <?php } ?>

    <?php ActiveForm::end(); ?>

</div>
