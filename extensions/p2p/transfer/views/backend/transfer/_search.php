<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model p2p\transfer\searches\ProjectInvestTransferApplySearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="project-invest-transfer-apply-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'project_invest_transfer_apply_id') ?>

    <?= $form->field($model, 'project_invest_id') ?>

    <?= $form->field($model, 'project_id') ?>

    <?= $form->field($model, 'member_id') ?>

    <?= $form->field($model, 'min_money') ?>

    <?php // echo $form->field($model, 'total_invest_money') ?>

    <?php // echo $form->field($model, 'discount_rate') ?>

    <?php // echo $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'verify_user') ?>

    <?php // echo $form->field($model, 'verify_date') ?>

    <?php // echo $form->field($model, 'counter_fee') ?>

    <?php // echo $form->field($model, 'create_time') ?>

    <?php // echo $form->field($model, 'update_time') ?>

    <?php // echo $form->field($model, 'is_delete') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('p2p_transfer', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('p2p_transfer', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
