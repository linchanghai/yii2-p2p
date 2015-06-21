<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model p2p\activity\models\ProjectInvest */

$this->title = $model->project_invest_id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('p2p_activity', 'Project Invests'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="project-invest-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('p2p_activity', 'Delete'), ['delete', 'id' => $model->project_invest_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('p2p_activity', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'project_invest_id',
            'project_id',
            'member_id',
            'rate',
            'invest_money',
            'interest_money',
            'create_time:datetime',
            'update_time:datetime',
            'status',
            'is_delete',
            'actual_invest_money',
        ],
    ]) ?>

</div>
