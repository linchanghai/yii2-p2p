<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model p2p\activity\models\Project */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="project-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'project_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'project_no')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'invest_total_money')->textInput() ?>

    <?= $form->field($model, 'interest_rate')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'repayment_date')->textInput() ?>

    <?= $form->field($model, 'repayment_type')->textInput() ?>

    <?= $form->field($model, 'release_date')->textInput() ?>

    <?= $form->field($model, 'project_type')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'create_user')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'invested_money')->textInput() ?>

    <?= $form->field($model, 'total_invest_money')->textInput() ?>

    <?= $form->field($model, 'verify_user')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'verify_date')->textInput() ?>

    <?= $form->field($model, 'min_money')->textInput() ?>

    <?= $form->field($model, 'status')->textInput() ?>

    <?= $form->field($model, 'create_time')->textInput() ?>

    <?= $form->field($model, 'update_time')->textInput() ?>

    <?= $form->field($model, 'is_delete')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('p2p_activity', 'Create') : Yii::t('p2p_activity', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
