<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel p2p\project\searches\ProjectInvestEmpiricRecordSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('p2p_project', 'Project Invest Point Records');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="project-invest-point-record-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

//            'project_invest_point_id',
//            'project_invest_id',
//            'project_id',
//            'member_id',
            'point',
             'create_time:datetime',
            // 'is_delete',

            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '<div style="width: 30px">{view} {delete}</div>'
            ],
        ],
    ]); ?>

</div>
