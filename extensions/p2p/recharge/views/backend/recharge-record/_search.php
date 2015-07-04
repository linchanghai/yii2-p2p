<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model p2p\recharge\models\RechargeRecordSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="recharge-record-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'recharge_record_id') ?>

    <?= $form->field($model, 'transaction_id') ?>

    <?= $form->field($model, 'member_id') ?>

    <?= $form->field($model, 'money') ?>

    <?= $form->field($model, 'recharge_type') ?>

    <?php // echo $form->field($model, 'use_for_type') ?>

    <?php // echo $form->field($model, 'use_for_id') ?>

    <?php // echo $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'create_time') ?>

    <?php // echo $form->field($model, 'update_time') ?>

    <?php // echo $form->field($model, 'is_delete') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('p2p_recharge', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('p2p_recharge', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
