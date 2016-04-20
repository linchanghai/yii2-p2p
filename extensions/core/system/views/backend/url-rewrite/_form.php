<?php

use yii\helpers\Html;
use kartik\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model core\system\models\UrlRewrite */
/* @var $form kartik\widgets\ActiveForm */
?>

<div class="url-rewrite-form">

    <?php $form = ActiveForm::begin([
        'id' => 'url-rewrite-form-horizontal',
        'type' => ActiveForm::TYPE_HORIZONTAL,
        'formConfig' => ['labelSpan' => 2],
        'fullSpan' => 11
    ]); ?>

    <?= $form->field($model, 'request_path')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'route')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'params')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-9">
            <?= Html::submitButton($model->isNewRecord ? Yii::t('core_system', 'Create') : Yii::t('core_system', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>
