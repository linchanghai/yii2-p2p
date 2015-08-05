<?php

use yii\helpers\Html;
use kartik\widgets\ActiveForm;
use kiwi\Kiwi;

/* @var $this yii\web\View */
/* @var $model p2p\transfer\models\ProjectInvestTransferApply */
/* @var $form yii\widgets\ActiveForm */

/** @var p2p\project\models\Project $project */
$project = $model->project;

/** @var core\member\models\Member $member */
$member = $model->member;

$transferClass = Kiwi::getProjectInvestTransferApplyClass();
$disabled = $model->status == $transferClass::STATUS_PENDING ? false : 'disabled';
?>

<div class="project-invest-transfer-apply-form">

    <?php $form = ActiveForm::begin([
        'id' => 'project-invest-transfer-apply-form-horizontal',
        'type' => ActiveForm::TYPE_HORIZONTAL,
        'formConfig' => ['labelSpan' => 2],
        'fullSpan' => 11,
        'disabled' => $disabled
    ]); ?>

    <?= $form->field($project, 'project_name')->textInput() ?>

    <?= $form->field($member, 'username')->textInput() ?>

    <?= $form->field($model, 'min_money')->textInput() ?>

    <?= $form->field($model, 'total_invest_money')->textInput() ?>

    <?= $form->field($model, 'discount_rate')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'status')->dropDownList(Kiwi::getDataListModel()->transferCheckStatus) ?>

    <?= $form->field($model, 'counter_fee')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-9">
            <?php
            if(!$disabled) {
                echo Html::submitButton($model->isNewRecord ? Yii::t('p2p_transfer', 'Create') : Yii::t('p2p_transfer', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']);
            }
            ?>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>