<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel p2p\activity\searches\ProjectDetailsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('p2p_activity', 'Project Details');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="project-details-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('p2p_activity', 'Create Project Details'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'project_details_id',
            'project_id',
            'project_introduce',
            'loan_person_info',
            'repayment_source:ntext',
            // 'collateral_info:ntext',
            // 'risk_control_info:ntext',
            // 'create_time:datetime',
            // 'update_time:datetime',
            // 'is_delete',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
