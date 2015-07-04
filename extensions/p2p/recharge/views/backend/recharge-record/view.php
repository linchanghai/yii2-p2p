<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model p2p\recharge\models\RechargeRecord */

$this->title = $model->recharge_record_id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('p2p_recharge', 'Recharge Records'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="recharge-record-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('p2p_recharge', 'Update'), ['update', 'id' => $model->recharge_record_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('p2p_recharge', 'Delete'), ['delete', 'id' => $model->recharge_record_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('p2p_recharge', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'recharge_record_id',
            'transaction_id',
            'member_id',
            'money',
            'recharge_type',
            'use_for_type',
            'use_for_id',
            'status',
            'create_time:datetime',
            'update_time:datetime',
            'is_delete',
        ],
    ]) ?>

</div>
