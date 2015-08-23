<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model p2p\project\searches\ProjectSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="project-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'project_id') ?>

    <?= $form->field($model, 'project_name') ?>

    <?= $form->field($model, 'project_no') ?>

    <?= $form->field($model, 'invest_total_money') ?>

    <?= $form->field($model, 'interest_rate') ?>

    <?php // echo $form->field($model, 'repayment_date') ?>

    <?php // echo $form->field($model, 'repayment_type') ?>

    <?php // echo $form->field($model, 'release_date') ?>

    <?php // echo $form->field($model, 'project_type') ?>

    <?php // echo $form->field($model, 'create_user') ?>

    <?php // echo $form->field($model, 'invested_money') ?>

    <?php // echo $form->field($model, 'verify_user') ?>

    <?php // echo $form->field($model, 'verify_date') ?>

    <?php // echo $form->field($model, 'min_money') ?>

    <?php // echo $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'create_time') ?>

    <?php // echo $form->field($model, 'update_time') ?>

    <?php // echo $form->field($model, 'is_delete') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('p2p_project', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('p2p_project', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
