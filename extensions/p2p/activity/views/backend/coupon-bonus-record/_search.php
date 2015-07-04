<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model p2p\activity\searches\CouponBonusRecordSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="coupon-bonus-record-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'coupon_bonus_record_id') ?>

    <?= $form->field($model, 'project_invest_id') ?>

    <?= $form->field($model, 'project_id') ?>

    <?= $form->field($model, 'member_id') ?>

    <?= $form->field($model, 'discount_money') ?>

    <?php // echo $form->field($model, 'create_time') ?>

    <?php // echo $form->field($model, 'is_delete') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('p2p_activity', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('p2p_activity', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
