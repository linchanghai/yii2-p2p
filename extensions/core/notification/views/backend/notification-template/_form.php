<?php

use kiwi\Kiwi;
use yii\helpers\Html;
use kartik\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model core\notification\models\NotificationTemplate */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="notification-template-form">

    <?php $form = ActiveForm::begin([
        'type' => ActiveForm::TYPE_HORIZONTAL,
        'formConfig' => ['labelSpan' => 2],
        'fullSpan' => 11
    ]); ?>

    <?= $form->field($model, 'event')->dropDownList(Yii::$app->dataList->notificationEvents) ?>

    <?= $form->field($model, 'type')->dropDownList(Yii::$app->dataList->notificationTypes) ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'template')->textarea(['maxlength' => true]) ?>

    <?= $form->field($model, 'receiver')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'active')->dropDownList(Yii::$app->dataList->boolean) ?>

    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-9">
            <?= Html::submitButton($model->isNewRecord ? Yii::t('core_notification', 'Create') : Yii::t('core_notification', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>
