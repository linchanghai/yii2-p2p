<?php

use yii\helpers\Html;
use kartik\widgets\ActiveForm;
use yii\bootstrap\Tabs;
use mihaildev\ckeditor\CKEditor;
use yii\helpers\Url;
use kartik\datetime\DateTimePicker;

/* @var $this yii\web\View */
/* @var $model p2p\activity\models\Project */
/* @var $form yii\widgets\ActiveForm */

if(isset($model->repayment_date) && isset($model->release_date) && isset($model->verify_date)) {
    $model->repayment_date = date('Y-m-d H:i', $model->repayment_date);
    $model->release_date = date('Y-m-d H:i', $model->release_date);
    $model->verify_date = date('Y-m-d H:i', $model->verify_date);
    $repayment_date = $model->repayment_date;
    $release_date = $model->release_date;
    $verify_date = $model->verify_date;
} else {
    $repayment_date = date('Y-m-d H:i', time());
    $release_date = date('Y-m-d H:i', time());
    $verify_date = date('Y-m-d H:i', time());
}
?>
<div class="project-form">

    <?php $form = ActiveForm::begin([
        'id' => 'project-form-horizontal',
        'type' => ActiveForm::TYPE_HORIZONTAL,
        'formConfig' => ['labelSpan' => 2],
        'fullSpan' => 11
    ]);
    $fieldGroups = [];
    $fields = ['<br />'];
    $fields[] = $form->field($model, 'project_name')->textInput(['maxlength' => 255]);
    $fields[] = $form->field($model, 'project_no')->textInput(['maxlength' => 255]);
    $fields[] = $form->field($model, 'invest_total_money')->textInput(['maxlength' => 255]);
    $fields[] = $form->field($model, 'interest_rate')->textInput(['maxlength' => 255]);
    $fields[] = $form->field($model, 'repayment_date')->widget(DateTimePicker::className(),[
        'options' => [
            'value' => $repayment_date
        ],
        'pluginOptions' => [
            'language' => 'zh-CN',
            'autoclose'=>true,
        ]
    ]);
    $fields[] = $form->field($model, 'repayment_type')->textInput(['maxlength' => 255]);
    $fields[] = $form->field($model, 'release_date')->widget(DateTimePicker::className(),[
        'options' => [
            'value' => $release_date
        ],
        'pluginOptions' => [
            'language' => 'zh-CN',
            'autoclose'=>true,
        ]
    ]);
    $fields[] = $form->field($model, 'project_type')->textInput(['maxlength' => 255]);
    $fields[] = $form->field($model, 'invested_money')->textInput(['maxlength' => 255]);
    $fields[] = $form->field($model, 'verify_user')->textInput(['maxlength' => 255]);
    $fields[] = $form->field($model, 'verify_date')->widget(DateTimePicker::className(),[
        'options' => [
            'value' => $verify_date
        ],
        'pluginOptions' => [
            'language' => 'zh-CN',
            'autoclose'=>true,
        ]
    ]);
    $fields[] = $form->field($model, 'min_money')->textInput(['maxlength' => 255]);
    $fields[] = $form->field($model, 'status')->textInput(['maxlength' => 255]);
    $fieldGroups[] = ['label' => Yii::t('p2p_activity','Project Base Info'), 'content' => implode('', $fields)];

    $fields = ['<br />'];
    $projectDetails = $model->projectDetails ?:\kiwi\Kiwi::getProjectDetails();
    $fields[] = $form->field($projectDetails, 'project_introduce')->textarea();
    $fields[] = $form->field($projectDetails, 'loan_person_info')->textarea();
    $fields[] = $form->field($projectDetails, 'repayment_source')->textarea();
    $fields[] = $form->field($projectDetails, 'collateral_info')->textarea();
    $fields[] = $form->field($projectDetails, 'risk_control_info')->textarea();
    $fieldGroups[] = ['label' => Yii::t('p2p_activity','Project Details'), 'content' => implode('', $fields)];

    $fields = ['<br />'];
    $projectLegalOpinion = $model->projectLegalOpinion ?:\kiwi\Kiwi::getProjectLegalOpinion();
    $fields[] = $form->field($projectLegalOpinion, 'legal_info')->widget(CKEditor::className(),[
        'name' => 'legal_info',
        'editorOptions' => [
            'filebrowserBrowseUrl' => Url::to(['/elfinder/manager']),
            'preset' => 'standard',
        ]
    ]);
    $fieldGroups[] = ['label' => Yii::t('p2p_activity','Project Legal Opinion'), 'content' => implode('', $fields)];

    $fields = ['<br />'];
    $projectMaterial = $model->projectMaterial ?:\kiwi\Kiwi::getProjectMaterial();
    $fields[] = $form->field($projectMaterial, 'material')->widget(CKEditor::className(),[
        'name' => 'material',
        'editorOptions' => [
            'filebrowserBrowseUrl' => Url::to(['/elfinder/manager']),
            'preset' => 'standard',
        ]
    ]);
    $fieldGroups[] = ['label' => Yii::t('p2p_activity','Project Material'), 'content' => implode('', $fields)];

    echo Tabs::widget(['items' => $fieldGroups]);
    ?>

    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-9">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('p2p_activity', 'Create') : Yii::t('p2p_activity', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>
