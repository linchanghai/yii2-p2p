<?php
use yii\widgets\DetailView;
use yii\jui\Tabs;
use kartik\grid\GridView;
use yii\data\ActiveDataProvider;
use kiwi\Kiwi;

$fieldGroups = [];

$fields = [];
$fields[] =  DetailView::widget([
    'model' => $model,
    'attributes' => [
        'project_name',
        'project_no',
        'invest_total_money',
        'interest_rate',
        'repayment_date:datetime',
        [
            'attribute'=>'repayment_type',
            'value'=> Kiwi::getDataListModel()->projectRepaymentType[$model->repayment_type]
        ],
        'release_date:datetime',
        [
            'attribute'=>'project_type',
            'value'=>Kiwi::getDataListModel()->projectType[$model->project_type]
        ],
        'invested_money',
        'min_money',
        [
            'attribute'=>'status',
            'value'=>
                Kiwi::getDataListModel()->projectStatus[$model->project_type]

        ],
    ],
]);
$fieldGroups[] = ['label' => Yii::t('p2p_project', 'Project Base Info'), 'content' => implode('', $fields)];

$fields = [];
$projectInvestClass = Kiwi::getProjectInvestClass();
$dataProvider = new ActiveDataProvider([
    'query' =>  $projectInvestClass::find()->andWhere(['project_id'=>$model->project_id]),
]);
$fields[] = GridView::widget([
    'dataProvider' => $dataProvider,
    'columns' => [
        ['class' => 'yii\grid\SerialColumn'],

//            'project_invest_id',
//            'project_id',
        'project.project_name',
//            'member_id',
        'member.username',
        'rate',
        'invest_money',
        'interest_money',
        'status',
        // 'is_delete',
        'actual_invest_money',
        'create_time:datetime',
//             'update_time:datetime',
        [
            'class' => 'yii\grid\ActionColumn',
            'template' => '<div style="width: 30px">{view} {delete}</div>'
        ],
    ],
    'export' => false,
    'responsive' => true,
    'containerOptions' => ['style' => 'overflow: auto'], // only set when $responsive = false
    'headerRowOptions' => ['class' => 'kartik-sheet-style'],
    'panel' => [
        'type' => GridView::TYPE_DEFAULT,
        'before' => false,
        'after' => false,
        'footer' => false
    ],
]);;
$fieldGroups[] = ['label' => Yii::t('p2p_project', 'Project Invests'), 'content' => implode('', $fields)];

$fields = [];
$projectInvestClass = Kiwi::getProjectRepaymentClass();
$dataProvider = new ActiveDataProvider([
    'query' =>  $projectInvestClass::find()->andWhere(['project_id'=>$model->project_id]),
]);
$fields[] = GridView::widget([
    'dataProvider' => $dataProvider,
    'columns' => [
        ['class' => 'yii\grid\SerialColumn'],
        'interest_money',
        'invest_money',
        'repayment_date',
        'status',
        'is_transfer',
        [
            'class' => 'yii\grid\ActionColumn',
            'template' => '<div style="width: 30px">{view} {delete}</div>'
        ],
        [
            'class' => 'yii\grid\ActionColumn',
            'template' => '<div style="width: 30px">{view} {delete}</div>'
        ],
    ],
    'export' => false,
    'responsive' => true,
    'containerOptions' => ['style' => 'overflow: auto'], // only set when $responsive = false
    'headerRowOptions' => ['class' => 'kartik-sheet-style'],
    'panel' => [
        'type' => GridView::TYPE_DEFAULT,
        'before' => false,
        'after' => false,
        'footer' => false
    ],
]);;
$fieldGroups[] = ['label' => Yii::t('p2p_project', 'Project Invests'), 'content' => implode('', $fields)];

echo Tabs::widget(['items' => $fieldGroups]);
?>