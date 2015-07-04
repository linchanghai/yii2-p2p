<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model p2p\package\searches\PackageInterestRecordSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="package-interest-record-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'package_interest_record_id') ?>

    <?= $form->field($model, 'member_id') ?>

    <?= $form->field($model, 'daily_interest') ?>

    <?= $form->field($model, 'target_date') ?>

    <?= $form->field($model, 'create_time') ?>

    <?php // echo $form->field($model, 'is_delete') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('p2p_package', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('p2p_package', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
