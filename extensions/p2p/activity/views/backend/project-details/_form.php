<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model p2p\activity\models\ProjectDetails */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="project-details-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'project_id')->textInput() ?>

    <?= $form->field($model, 'project_introduce')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'loan_person_info')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'repayment_source')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'collateral_info')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'risk_control_info')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'create_time')->textInput() ?>

    <?= $form->field($model, 'update_time')->textInput() ?>

    <?= $form->field($model, 'is_delete')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('p2p_activity', 'Create') : Yii::t('p2p_activity', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
