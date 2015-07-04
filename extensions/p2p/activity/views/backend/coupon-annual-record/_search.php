<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model p2p\activity\searches\CouponAnnualRecordSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="coupon-annual-record-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'coupon_annual_record_id') ?>

    <?= $form->field($model, 'project_invest_id') ?>

    <?= $form->field($model, 'project_id') ?>

    <?= $form->field($model, 'member_id') ?>

    <?= $form->field($model, 'member_coupon_id') ?>

    <?php // echo $form->field($model, 'rate') ?>

    <?php // echo $form->field($model, 'interst_money') ?>

    <?php // echo $form->field($model, 'create_time') ?>

    <?php // echo $form->field($model, 'is_delete') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('p2p_activity', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('p2p_activity', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
