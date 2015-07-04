<?php

use yii\helpers\Html;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel p2p\package\searches\PackageInterestRecordSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('p2p_package', 'Package Interest Records');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="package-interest-record-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

//            'package_interest_record_id',
            'member.username',
            'daily_interest',
            'target_date:datetime',
//            'create_time:datetime',
            // 'is_delete',

//            [
//                'class' => 'yii\grid\ActionColumn',
//                'template' => '<div style="width: 30px">{view} {delete}</div>'
//            ],
        ],
        'export' => false,
        'responsive' => true,
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
