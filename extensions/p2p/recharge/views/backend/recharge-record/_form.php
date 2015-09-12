<?php

use yii\helpers\Html;
use kartik\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model p2p\recharge\models\RechargeRecord */
/* @var $form kartik\widgets\ActiveForm */
?>

<div class="recharge-record-form">

    <?php $form = ActiveForm::begin([
        'id' => 'recharge-record-form-horizontal',
        'type' => ActiveForm::TYPE_HORIZONTAL,
        'formConfig' => ['labelSpan' => 2],
        'fullSpan' => 11
    ]); ?>

    <?= $form->field($model, 'transaction_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'money')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'recharge_type')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'use_for_type')->textInput() ?>

    <?= $form->field($model, 'use_for_id')->textInput() ?>

    <?= $form->field($model, 'status')->textInput() ?>

    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-9">
            <?= Html::submitButton($model->isNewRecord ? Yii::t('p2p_recharge', 'Create') : Yii::t('p2p_recharge', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>
