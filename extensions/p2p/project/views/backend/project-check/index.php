<?php

use yii\helpers\Html;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel p2p\project\searches\ProjectSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('p2p_project', 'Projects Check');
$this->params['breadcrumbs'][] = $this->title;
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
            'interest_rate',
            // 'repayment_date',
            'repayment_type',
            // 'release_date',
            'project_type',
            // 'create_user',
//            'invested_money',
            // 'verify_user',
            // 'verify_date',
             'min_money',
//             'status',
            // 'create_time:datetime',
            // 'update_time:datetime',
            // 'is_delete',

            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '<div style="width: 30px">{update} {delete}</div>'
            ],
        ],
        'export' => false,
        'responsive' => true,
//        'toolbar' => Html::a(Yii::t('p2p_project', 'Create Project'), ['create'], ['class' => 'btn btn-info']),
        'containerOptions' => ['style' => 'overflow: auto'], // only set when $responsive = false
        'headerRowOptions' => ['class' => 'kartik-sheet-style'],
        'filterRowOptions' => ['class' => 'kartik-sheet-style'],
        'panelHeadingTemplate' => '<h3 class="panel-title"><i class="glyphicon glyphicon-globe"></i> ' . Html::encode($this->title) . '</h3>',
        'panel' => [
            'type' => GridView::TYPE_DEFAULT,
            'before' => false,
            'after' => false,
            'footer' => false
        ],
    ]); ?>

</div>
