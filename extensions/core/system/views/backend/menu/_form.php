<?php

use kiwi\Kiwi;
use yii\helpers\Html;
use kartik\widgets\ActiveForm;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $model core\system\models\Menu */
/* @var $form kartik\widgets\ActiveForm */
?>

<?php Pjax::begin(['id' => 'pjax-Menu-form', 'formSelector' => '#Menu-form']) ?>
<div class="Menu-form">

    <?php $form = ActiveForm::begin([
        'id' => 'Menu-form-horizontal',
        'type' => ActiveForm::TYPE_HORIZONTAL,
        'formConfig' => ['labelSpan' => 2],
        'fullSpan' => 11
    ]); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'url')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'status')->dropDownList(Yii::$app->dataList->boolean) ?>

    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-9">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('core_system', 'Create') : Yii::t('core_system', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>
        </div>

    <?php $form->end(); ?>

</div>
<?php Pjax::end() ?>
