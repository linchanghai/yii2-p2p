<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model p2p\project\models\Project */

$this->title = $model->project_id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('p2p_project', 'Projects Check'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="project-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('p2p_project', 'Update'), ['update', 'id' => $model->project_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('p2p_project', 'Delete'), ['delete', 'id' => $model->project_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('p2p_project', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
//            'project_id',
            'project_name',
            'project_no',
            'invest_total_money',
            'interest_rate',
            'repayment_date',
            'repayment_type',
            'release_date',
            'project_type',
            'create_user',
            'invested_money',
            'verify_user',
            'verify_date',
            'min_money',
            'status',
//            'create_time:datetime',
//            'update_time:datetime',
//            'is_delete',
        ],
    ]) ?>

</div>
