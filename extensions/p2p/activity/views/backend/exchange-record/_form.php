<?php

use yii\helpers\Html;
use kartik\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model p2p\activity\models\ExchangeRecord */
/* @var $form kartik\widgets\ActiveForm */
?>

<div class="exchange-record-form">

    <?php $form = ActiveForm::begin([
        'id' => 'exchange-record-form-horizontal',
        'type' => ActiveForm::TYPE_HORIZONTAL,
        'formConfig' => ['labelSpan' => 2],
        'fullSpan' => 11
    ]); ?>

    <?= $form->field($model, 'member_id')->textInput() ?>

    <?= $form->field($model, 'product_map_id')->textInput() ?>

    <?= $form->field($model, 'note')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'create_time')->textInput() ?>

    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-9">
            <?= Html::submitButton($model->isNewRecord ? Yii::t('p2p_activity', 'Create') : Yii::t('p2p_activity', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>
