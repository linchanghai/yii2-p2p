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

    <?= $form->field($model, 'deposit_type')->textInput(['value' => Kiwi::getDataListModel()->withdrawStatus[$model->deposit_type]]) ?>

    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-9">
            <?= Html::submitButton($model->isNewRecord ? Yii::t('p2p_withdraw', 'Create') : Yii::t('p2p_withdraw', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>
