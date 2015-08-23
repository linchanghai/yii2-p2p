<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model p2p\recharge\models\RechargeRecord */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="recharge-record-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'transaction_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'money')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'recharge_type')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'use_for_type')->textInput() ?>

    <?= $form->field($model, 'use_for_id')->textInput() ?>

    <?= $form->field($model, 'status')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('p2p_recharge', 'Create') : Yii::t('p2p_recharge', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
