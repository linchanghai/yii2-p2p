<?php
use kartik\form\ActiveForm;
use yii\helpers\Html;
?>
<div class="member-form">

    <?php $form = ActiveForm::begin([
    'id' => 'member-form-horizontal',
    'type' => ActiveForm::TYPE_HORIZONTAL,
    'formConfig' => ['labelSpan' => 2],
    'fullSpan' => 11
]); ?>

<?= $form->field($model, 'real_name')->textInput(['maxlength' => true]) ?>

<?= $form->field($model, 'id_card')->textInput(['maxlength' => true]) ?>

<div class="form-group">
    <div class="col-sm-offset-2 col-sm-9">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('core_member', 'Create') : Yii::t('core_member', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>
</div>

<?php ActiveForm::end(); ?>

</div>
