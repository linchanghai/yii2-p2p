<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel p2p\activity\searches\ProjectInvestSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('p2p_activity', 'Project Invests');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="project-invest-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

//            'project_invest_id',
            'project_id',
            'member_id',
            'rate',
            'invest_money',
             'interest_money',
            // 'create_time:datetime',
            // 'update_time:datetime',
             'status',
            // 'is_delete',
             'actual_invest_money',

            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '<div style="width: 30px">{view} {delete}</div>'
            ],
        ],
    ]); ?>

</div>
