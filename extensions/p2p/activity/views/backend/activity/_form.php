<?php

use kiwi\Kiwi;
use yii\helpers\Html;
use kartik\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model p2p\activity\models\Activity */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="activity-form">

    <?php $form = ActiveForm::begin([
        'type' => ActiveForm::TYPE_HORIZONTAL,
        'formConfig' => ['labelSpan' => 2],
        'fullSpan' => 11
    ]); ?>

    <?= $form->field($model, 'activity_type')->dropDownList(Kiwi::getDataListModel()->activityTypes) ?>

    <?= $form->field($model, 'activity_send_type')->dropDownList(Kiwi::getDataListModel()->activitySendTypes) ?>

    <?= $form->field($model, 'activity_send_value')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'valid_date')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('p2p_activity', 'Create') : Yii::t('p2p_activity', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
