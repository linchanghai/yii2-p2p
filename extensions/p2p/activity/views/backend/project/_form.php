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
    $fields[] = $form->field($model, 'repayment_type')->textInput(['maxlength' => 255]);
    $fields[] = $form->field($model, 'release_date')->textInput(['maxlength' => 255]);
    $fields[] = $form->field($model, 'project_type')->textInput(['maxlength' => 255]);
    $fields[] = $form->field($model, 'invested_money')->textInput(['maxlength' => 255]);
    $fields[] = $form->field($model, 'verify_user')->textInput(['maxlength' => 255]);
    $fields[] = $form->field($model, 'verify_date')->widget(\kartik\datetime\DateTimePicker::className(),[
        'name' => 'verify_date',
        'options' => ['placeholder' => 'Please select time ...'],
        'convertFormat' => true,
        'pluginOptions' => [
            'format' => 'd-M-Y g:i A',
            'todayHighlight' => true,
            'autoclose' => true,
        ]
    ]);
    $fields[] = $form->field($model, 'min_money')->textInput(['maxlength' => 255]);
    $fields[] = $form->field($model, 'status')->textInput(['maxlength' => 255]);
    $fieldGroups[] = ['label' => Yii::t('p2p_activity','Project Base Info'), 'content' => implode('', $fields)];

    $fields = [];
    $projectDetails = $model->projectDetails ?:\kiwi\Kiwi::getProjectDetails();
    $fields[] = $form->field($projectDetails, 'project_introduce')->textInput(['maxlength' => 255]);
    $fields[] = $form->field($projectDetails, 'loan_person_info')->textInput(['maxlength' => 255]);
    $fields[] = $form->field($projectDetails, 'repayment_source')->textInput(['maxlength' => 255]);
    $fields[] = $form->field($projectDetails, 'collateral_info')->textInput(['maxlength' => 255]);
    $fields[] = $form->field($projectDetails, 'risk_control_info')->textInput(['maxlength' => 255]);
    $fieldGroups[] = ['label' => Yii::t('p2p_activity','Project Details'), 'content' => implode('', $fields)];

    $fields = [];
    $projectLegalOpinion = $model->projectLegalOpinion ?:\kiwi\Kiwi::getProjectLegalOpinion();
    $fields[] = $form->field($projectLegalOpinion, 'legal_info')->textInput(['maxlength' => 255]);
    $fieldGroups[] = ['label' => Yii::t('p2p_activity','Project Legal Opinion'), 'content' => implode('', $fields)];

    $fields = [];
    $projectMaterial = $model->projectMaterial ?:\kiwi\Kiwi::getProjectMaterial();
    $fields[] = $form->field($projectMaterial, 'material')->textInput(['maxlength' => 255]);
    $fieldGroups[] = ['label' => Yii::t('p2p_activity','Project Material'), 'content' => implode('', $fields)];

    echo Tabs::widget(['items' => $fieldGroups]);
    ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('p2p_activity', 'Create') : Yii::t('p2p_activity', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
