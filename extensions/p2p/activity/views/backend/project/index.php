<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel p2p\activity\searches\ProjectSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('p2p_activity', 'Projects');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="project-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('p2p_activity', 'Create Project'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

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
                'template' => '<div style="width: 30px">{update} {delete}</div>'
            ],
        ],
    ]); ?>

</div>
