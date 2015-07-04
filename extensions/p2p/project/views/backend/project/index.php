<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use kiwi\Kiwi;

/* @var $this yii\web\View */
/* @var $searchModel p2p\project\searches\ProjectSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$projectClass = Kiwi::getProjectClass();
if ($status == $projectClass::PROJECT_STATUS_PASSED) {
    $this->title = Yii::t('p2p_project', 'Project Passed');
} else if ($status == $projectClass::PROJECT_STATUS_FAIlED) {
    $this->title = Yii::t('p2p_project', 'Project Failed');
} else if ($status == $projectClass::PROJECT_STATUS_Repaying) {
    $this->title = Yii::t('p2p_project', 'Project Repaying');
} else if ($status == $projectClass::PROJECT_STATUS_End) {
    $this->title = Yii::t('p2p_project', 'Project End');
}
$this->title = Yii::t('p2p_project', 'Projects');
$this->params['breadcrumbs'][] = $this->title;

$projectClass = Kiwi::getProjectClass();
$createButton = $status == $projectClass::PROJECT_STATUS_PENDING ? true : false;
if($createButton) {
    $buttonTemplate = '<div style="width: 30px">{update} {delete}</div>';
} else {
    $buttonTemplate = '<div style="width: 30px">{update}</div>';
}
?>
<div class="project-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

//            'project_id',
            'project_name',
            'project_no',
            'invest_total_money',
            [
                'label' => Yii::t('p2p_project', 'Interest Rate') . '(%)',
                'attribute'=>'interest_rate',
            ],
            // 'repayment_date',
            [
                'attribute'=>'repayment_type',
                'value'=>function ($model) {
                    return Kiwi::getDataListModel()->projectRepaymentType[$model->repayment_type] ;
                },
                'width' => '175px'
            ],
            // 'release_date',
            [
                'attribute'=>'project_type',
                'value'=>function ($model) {
                    return Kiwi::getDataListModel()->projectType[$model->project_type] ;
                },
            ],
            // 'create_user',
            'invested_money',
            // 'verify_user',
            // 'verify_date',
            // 'min_money',
            // 'status',
            // 'create_time:datetime',
            // 'update_time:datetime',
            // 'is_delete',

            [
                'class' => 'yii\grid\ActionColumn',
                'template' => $buttonTemplate
            ],
        ],
        'export' => false,
        'responsive' => true,
        'toolbar' => $createButton ? Html::a(Yii::t('p2p_project', 'Create Project'), ['create'], ['class' => 'btn btn-info']) : $createButton,
        'containerOptions' => ['style' => 'overflow: auto'], // only set when $responsive = false
        'headerRowOptions' => ['class' => 'kartik-sheet-style'],
        'filterRowOptions' => ['class' => 'kartik-sheet-style'],
        'panelHeadingTemplate' => '<h3 class="panel-title"><i class="glyphicon glyphicon-globe"></i> ' . Html::encode($this->title) . '</h3>',
        'panel' => [
            'type' => GridView::TYPE_DEFAULT,
//            'before' => Html::a(Yii::t('p2p_project', 'Create Project'), ['create'], ['class' => 'btn btn-info']),
            'before' => $createButton ? '' : false,
            'after' => false,
            'footer' => false,
        ],
    ]); ?>

</div>
