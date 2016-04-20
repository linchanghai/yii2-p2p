<?php

use yii\helpers\Html;
use kartik\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model core\cms\models\CmsHelp */
/* @var $form kartik\widgets\ActiveForm */
?>

<div class="cms-help-form">

    <?php $form = ActiveForm::begin([
        'id' => 'cms-help-form-horizontal',
        'type' => ActiveForm::TYPE_HORIZONTAL,
        'formConfig' => ['labelSpan' => 2],
        'fullSpan' => 11
    ]); ?>



    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'content')->widget(\mihaildev\ckeditor\CKEditor::className(), [
        'name' => 'legal_info',
        'editorOptions' => [
            'filebrowserBrowseUrl' => \yii\helpers\Url::to(['/elfinder/manager']),
            'preset' => 'standard',
            'language' => Yii::$app->language,
        ]
    ]); ?>

    <?= $form->field($model, 'type')->textInput() ?>

    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-9">
            <?= Html::submitButton($model->isNewRecord ? Yii::t('core_cms', 'Create') : Yii::t('core_cms', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>
