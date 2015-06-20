<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model p2p\activity\models\ProjectInvestPointRecord */

$this->title = $model->project_invest_point_record;
$this->params['breadcrumbs'][] = ['label' => Yii::t('p2p_activity', 'Project Invest Point Records'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="project-invest-point-record-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('p2p_activity', 'Update'), ['update', 'id' => $model->project_invest_point_record], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('p2p_activity', 'Delete'), ['delete', 'id' => $model->project_invest_point_record], [
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
            'project_invest_point_record',
            'project_invest_record_id',
            'project_id',
            'member_id',
            'point',
            'project_type',
            'create_time:datetime',
            'is_delete',
        ],
    ]) ?>

</div>
