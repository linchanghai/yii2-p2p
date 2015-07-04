<?php
use yii\helpers\Html;
use kartik\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model p2p\activity\models\CouponCashRecord */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="coupon-cash-record-form">

    <?php $form = ActiveForm::begin([
        'type' => ActiveForm::TYPE_HORIZONTAL,
        'formConfig' => ['labelSpan' => 2],
        'fullSpan' => 11
    ]); ?>

    <?= $form->field($model, 'project_invest_id')->textInput() ?>

    <?= $form->field($model, 'project_id')->textInput() ?>

    <?= $form->field($model, 'member_id')->textInput() ?>

    <?= $form->field($model, 'member_coupon_id')->textInput() ?>

    <?= $form->field($model, 'discount_money')->textInput() ?>

    <?= $form->field($model, 'create_time')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('p2p_activity', 'Create') : Yii::t('p2p_activity', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
