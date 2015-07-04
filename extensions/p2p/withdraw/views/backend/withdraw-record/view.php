<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model p2p\withdraw\models\WithdrawRecord */

$this->title = $model->deposit_record_id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('p2p_withdraw', 'Withdraw Records'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="withdraw-record-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('p2p_withdraw', 'Update'), ['update', 'id' => $model->deposit_record_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('p2p_withdraw', 'Delete'), ['delete', 'id' => $model->deposit_record_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('p2p_withdraw', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'deposit_record_id',
            'member_id',
            'money',
            'counter_fee',
            'deposit_type',
            'first_verify_user',
            'first_verify_date',
            'second_verify_user',
            'second_verify_date',
            'status',
            'create_time:datetime',
            'update_time:datetime',
            'is_delete',
        ],
    ]) ?>

</div>
