<?php

use kiwi\Kiwi;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $model core\system\models\Menu */
/* @var $form yii\widgets\ActiveForm */
?>

<?php Pjax::begin(['id' => 'pjax-Menu-form', 'formSelector' => '#Menu-form']) ?>
<div class="Menu-form">

    <?php $form = ActiveForm::begin(['id' => 'Menu-form']); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'url')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'status')->dropDownList(Kiwi::getDataListModel()->boolean) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('core_system', 'Create') : Yii::t('core_system', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php $form->end(); ?>

</div>
<?php Pjax::end() ?>
