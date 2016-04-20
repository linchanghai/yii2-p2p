<?php

use yii\helpers\Html;
use kartik\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model p2p\activity\models\ProductMap */
/* @var $form kartik\widgets\ActiveForm */
?>

<div class="product-map-form">

    <?php $form = ActiveForm::begin([
        'type' => ActiveForm::TYPE_HORIZONTAL,
        'formConfig' => ['labelSpan' => 2],
        'fullSpan' => 11
    ]); ?>

    <?= $form->field($model, 'type')->dropDownList($model->getTypeArray()) ?>

    <?= $form->field($model, 'exchange_value')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'exchange_points')->textInput() ?>

    <?= $form->field($model, 'duration')->textInput(['placeholder' => '有效期天数，即几天之后过期']) ?>

    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-9">
            <?= Html::submitButton($model->isNewRecord ? Yii::t('p2p_activity', 'Create') : Yii::t('p2p_activity', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>
