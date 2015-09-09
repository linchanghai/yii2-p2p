<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model p2p\activity\models\ActivityRecord */

$this->title = $model->activity_records_id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('p2p_activity', 'Activity Records'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="activity-record-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('p2p_activity', 'Update'), ['update', 'id' => $model->activity_records_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('p2p_activity', 'Delete'), ['delete', 'id' => $model->activity_records_id], [
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
            'activity_records_id',
            'member_id',
            'activity_id',
            'note',
            'create_time',
            'is_delete',
        ],
    ]) ?>

</div>
