<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model p2p\activity\models\ProjectRepayment */

$this->title = $model->project_repayment_id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('p2p_activity', 'Project Repayments'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="project-repayment-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('p2p_activity', 'Update'), ['update', 'id' => $model->project_repayment_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('p2p_activity', 'Delete'), ['delete', 'id' => $model->project_repayment_id], [
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
            'project_repayment_id',
            'project_invest_id',
            'project_id',
            'member_id',
            'interest_money',
            'invest_money',
            'repayment_date',
            'status',
            'is_transfer',
            'create_time:datetime',
            'update_time:datetime',
            'is_delete',
        ],
    ]) ?>

</div>
