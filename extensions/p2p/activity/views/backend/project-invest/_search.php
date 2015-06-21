<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model p2p\activity\searches\ProjectInvestSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="project-invest-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'project_invest_id') ?>

    <?= $form->field($model, 'project_id') ?>

    <?= $form->field($model, 'member_id') ?>

    <?= $form->field($model, 'rate') ?>

    <?= $form->field($model, 'invest_money') ?>

    <?php // echo $form->field($model, 'interest_money') ?>

    <?php // echo $form->field($model, 'create_time') ?>

    <?php // echo $form->field($model, 'update_time') ?>

    <?php // echo $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'is_delete') ?>

    <?php // echo $form->field($model, 'actual_invest_money') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('p2p_activity', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('p2p_activity', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
