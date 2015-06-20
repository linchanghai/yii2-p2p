<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model p2p\activity\searches\ProjectDetailsSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="project-details-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'project_details_id') ?>

    <?= $form->field($model, 'project_id') ?>

    <?= $form->field($model, 'project_introduce') ?>

    <?= $form->field($model, 'loan_person_info') ?>

    <?= $form->field($model, 'repayment_source') ?>

    <?php // echo $form->field($model, 'collateral_info') ?>

    <?php // echo $form->field($model, 'risk_control_info') ?>

    <?php // echo $form->field($model, 'create_time') ?>

    <?php // echo $form->field($model, 'update_time') ?>

    <?php // echo $form->field($model, 'is_delete') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('p2p_activity', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('p2p_activity', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
