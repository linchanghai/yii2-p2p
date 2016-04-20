<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model p2p\withdraw\searches\WithdrawRecordSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="withdraw-record-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'deposit_record_id') ?>

    <?= $form->field($model, 'member_id') ?>

    <?= $form->field($model, 'money') ?>

    <?= $form->field($model, 'counter_fee') ?>

    <?= $form->field($model, 'deposit_type') ?>

    <?php // echo $form->field($model, 'first_verify_user') ?>

    <?php // echo $form->field($model, 'first_verify_date') ?>

    <?php // echo $form->field($model, 'second_verify_user') ?>

    <?php // echo $form->field($model, 'second_verify_date') ?>

    <?php // echo $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'create_time') ?>

    <?php // echo $form->field($model, 'update_time') ?>

    <?php // echo $form->field($model, 'is_delete') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('p2p_withdraw', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('p2p_withdraw', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
