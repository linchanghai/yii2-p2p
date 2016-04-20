<?php

use yii\helpers\Html;
use kartik\widgets\ActiveForm;
use kartik\widgets\DepDrop;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model core\member\models\Member */
/* @var $form kartik\widgets\ActiveForm */
?>

<div class="member-form">

    <?php $form = ActiveForm::begin([
        'id' => 'member-form-horizontal',
        'type' => ActiveForm::TYPE_HORIZONTAL,
        'formConfig' => ['labelSpan' => 2],
        'fullSpan' => 11
    ]); ?>

    <?= $form->field($model, 'bank_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'card_no')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'bank_user_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'province')->dropDownList($catList, ['id'=>'cat-id']);?>

    <?= $form->field($model, 'city')->widget(DepDrop::classname(), [
    'data'=>[$model->city=>isset($model->cityArea)?$model->cityArea->name:''],
    'options'=>['id'=>'subcat-id'],
    'pluginOptions'=>[
    'depends'=>['cat-id'],
    'placeholder'=>'Select...',
    'url'=>UrL::to(['/member/member/get-cities'])
    ]
    ]);?>

    <?= $form->field($model, 'branch_name')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-9">
            <?= Html::submitButton($model->isNewRecord ? Yii::t('core_member', 'Create') : Yii::t('core_member', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>
