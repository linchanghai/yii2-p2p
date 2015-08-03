<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel p2p\transfer\searches\ProjectInvestTransferApplySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('p2p_transfer', 'Project Invest Transfer Applies');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="project-invest-transfer-apply-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('p2p_transfer', 'Create Project Invest Transfer Apply'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'project_invest_transfer_apply_id',
            'project_invest_id',
            'project_id',
            'member_id',
            'min_money',
            // 'total_invest_money',
            // 'discount_rate',
            // 'status',
            // 'verify_user',
            // 'verify_date',
            // 'counter_fee',
            // 'create_time:datetime',
            // 'update_time:datetime',
            // 'is_delete',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
