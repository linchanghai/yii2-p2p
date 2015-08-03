<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model p2p\transfer\models\ProjectInvestTransferApply */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="project-invest-transfer-apply-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'project_invest_id')->textInput() ?>

    <?= $form->field($model, 'project_id')->textInput() ?>

    <?= $form->field($model, 'member_id')->textInput() ?>

    <?= $form->field($model, 'min_money')->textInput() ?>

    <?= $form->field($model, 'total_invest_money')->textInput() ?>

    <?= $form->field($model, 'discount_rate')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'status')->textInput() ?>

    <?= $form->field($model, 'verify_user')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'verify_date')->textInput() ?>

    <?= $form->field($model, 'counter_fee')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'create_time')->textInput() ?>

    <?= $form->field($model, 'update_time')->textInput() ?>

    <?= $form->field($model, 'is_delete')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('p2p_transfer', 'Create') : Yii::t('p2p_transfer', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
