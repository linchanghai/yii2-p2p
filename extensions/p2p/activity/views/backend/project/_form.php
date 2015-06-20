<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\bootstrap\Tabs;

/* @var $this yii\web\View */
/* @var $model p2p\activity\models\Project */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="project-form">

    <?php $form = ActiveForm::begin();
    $fieldGroups = [];
    $fields = [];
    $fields[] = $form->field($model, 'project_name')->textInput(['maxlength' => 255]);
    $fields[] = $form->field($model, 'project_no')->textInput(['maxlength' => 255]);
    $fields[] = $form->field($model, 'invest_total_money')->textInput(['maxlength' => 255]);
    $fields[] = $form->field($model, 'interest_rate')->textInput(['maxlength' => 255]);
    $fields[] = $form->field($model, 'repayment_date')->textInput(['maxlength' => 255]);
    $fields[] = $form->field($model, 'release_date')->textInput(['maxlength' => 255]);
    $fields[] = $form->field($model, 'project_type')->textInput(['maxlength' => 255]);
    $fields[] = $form->field($model, 'invested_money')->textInput(['maxlength' => 255]);
    $fields[] = $form->field($model, 'verify_user')->textInput(['maxlength' => 255]);
    $fields[] = $form->field($model, 'verify_date')->textInput(['maxlength' => 255]);
    $fields[] = $form->field($model, 'min_money')->textInput(['maxlength' => 255]);
    $fields[] = $form->field($model, 'status')->textInput(['maxlength' => 255]);
    $fieldGroups[] = ['label' => Yii::t('p2p_activity','Project Base Info'), 'content' => implode('', $fields)];

    $fields = [];
    $fields[] = $form->field($model, 'projectDetails.project_introduce')->textInput(['maxlength' => 255]);
    $fields[] = $form->field($model, 'projectDetails.loan_person_info')->textInput(['maxlength' => 255]);
    $fields[] = $form->field($model, 'projectDetails.repayment_source')->textInput(['maxlength' => 255]);
    $fields[] = $form->field($model, 'projectDetails.collateral_info')->textInput(['maxlength' => 255]);
    $fields[] = $form->field($model, 'projectDetails.risk_control_info')->textInput(['maxlength' => 255]);
    $fieldGroups[] = ['label' => Yii::t('p2p_activity','Project Details'), 'content' => implode('', $fields)];

    echo Tabs::widget(['items' => $fieldGroups]);
    ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('p2p_activity', 'Create') : Yii::t('p2p_activity', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
