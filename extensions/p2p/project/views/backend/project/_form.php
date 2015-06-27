<?php

use kiwi\Kiwi;
use yii\helpers\Html;
use kartik\widgets\ActiveForm;
use yii\bootstrap\Tabs;
use mihaildev\ckeditor\CKEditor;
use yii\helpers\Url;
use kartik\datetime\DateTimePicker;

/* @var $this yii\web\View */
/* @var $model p2p\project\models\Project */
/* @var $form yii\widgets\ActiveForm */

if (isset($model->repayment_date) && isset($model->release_date)) {
    $model->repayment_date = date('Y-m-d H:i', $model->repayment_date);
    $model->release_date = date('Y-m-d H:i', $model->release_date);
    $repayment_date = $model->repayment_date;
    $release_date = $model->release_date;
} else {
    $repayment_date = date('Y-m-d H:i', time());
    $release_date = date('Y-m-d H:i', time());
}
$projectClass = Kiwi::getProjectClass();
if (!isset($model->status)) {
    $model->status = $projectClass::PROJECT_STATUS_PENDING;
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
    $fields[] = $form->field($model, 'repayment_date')->widget(DateTimePicker::className(), [
        'options' => [
            'value' => $repayment_date
        ],
        'pluginOptions' => [
            'language' => Yii::$app->language,
            'autoclose' => true,
        ]
    ]);
    $fields[] = $form->field($model, 'repayment_type')->textInput(['maxlength' => 255]);
    $fields[] = $form->field($model, 'release_date')->widget(DateTimePicker::className(), [
        'options' => [
            'value' => $release_date
        ],
        'pluginOptions' => [
            'language' => Yii::$app->language,
            'autoclose' => true,
        ]
    ]);
    $fields[] = $form->field($model, 'project_type')->dropDownList(Kiwi::getDataListModel()->projectType);
    $fields[] = $form->field($model, 'invested_money')->textInput([
        'value' => $model->invested_money ? $model->invested_money : 0,
        'disabled' => 'disabled'
    ]);
    //    $fields[] = $form->field($model, 'verify_user')->textInput(['maxlength' => 255]);
    //    $fields[] = $form->field($model, 'verify_date')->widget(DateTimePicker::className(),[
    //        'options' => [
    //            'value' => $verify_date
    //        ],
    //        'pluginOptions' => [
    //            'language' => Yii::$app->language,
    //            'autoclose'=>true,
    //        ]
    //    ]);
    $fields[] = $form->field($model, 'min_money')->textInput(['maxlength' => 255]);
    $fields[] = $form->field($model, 'status')->dropDownList([
        $model->status => Kiwi::getDataListModel()->projectStatus[$model->status]
    ], ['disabled' => 'disabled']);
    $fieldGroups[] = ['label' => Yii::t('p2p_project', 'Project Base Info'), 'content' => implode('', $fields)];

    $fields = ['<br />'];
    $projectDetails = $model->projectDetails ?: \kiwi\Kiwi::getProjectDetails();
    $fields[] = $form->field($projectDetails, 'project_introduce')->textarea();
    $fields[] = $form->field($projectDetails, 'loan_person_info')->textarea();
    $fields[] = $form->field($projectDetails, 'repayment_source')->textarea();
    $fields[] = $form->field($projectDetails, 'collateral_info')->textarea();
    $fields[] = $form->field($projectDetails, 'risk_control_info')->textarea();
    $fieldGroups[] = ['label' => Yii::t('p2p_project', 'Project Details'), 'content' => implode('', $fields)];

    $fields = ['<br />'];
    $projectLegalOpinion = $model->projectLegalOpinion ?: \kiwi\Kiwi::getProjectLegalOpinion();
    $fields[] = $form->field($projectLegalOpinion, 'legal_info')->widget(CKEditor::className(), [
        'name' => 'legal_info',
        'editorOptions' => [
            'filebrowserBrowseUrl' => Url::to(['/elfinder/manager']),
            'preset' => 'standard',
            'language' => Yii::$app->language,
        ]
    ]);
    $fieldGroups[] = ['label' => Yii::t('p2p_project', 'Project Legal Opinion'), 'content' => implode('', $fields)];

    $fields = ['<br />'];
    $projectMaterial = $model->projectMaterial ?: \kiwi\Kiwi::getProjectMaterial();
    $fields[] = $form->field($projectMaterial, 'material')->widget(CKEditor::className(), [
        'name' => 'material',
        'editorOptions' => [
            'filebrowserBrowseUrl' => Url::to(['/elfinder/manager']),
            'preset' => 'standard',
            'language' => Yii::$app->language,
        ]
    ]);
    $fieldGroups[] = ['label' => Yii::t('p2p_project', 'Project Material'), 'content' => implode('', $fields)];

    echo Tabs::widget(['items' => $fieldGroups]);
    ?>

    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-9">
            <?= Html::submitButton($model->isNewRecord ? Yii::t('p2p_project', 'Create') : Yii::t('p2p_project', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>
