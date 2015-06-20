<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $model core\category\models\Category */
/* @var $form yii\widgets\ActiveForm */
?>

<?php Pjax::begin(['id' => 'pjax-category-form', 'formSelector' => '#category-form']) ?>
<div class="category-form">

    <?php $form = ActiveForm::begin(['id' => 'category-form']); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('core_category', 'Create') : Yii::t('core_category', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php $form->end(); ?>

</div>
<?php Pjax::end() ?>
