<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model p2p\transfer\models\ProjectInvestTransferApply */

$this->title = $model->project_invest_transfer_apply_id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('p2p_transfer', 'Project Invest Transfer Applies'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="project-invest-transfer-apply-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('p2p_transfer', 'Update'), ['update', 'id' => $model->project_invest_transfer_apply_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('p2p_transfer', 'Delete'), ['delete', 'id' => $model->project_invest_transfer_apply_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('p2p_transfer', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'project_invest_transfer_apply_id',
            'project_invest_id',
            'project_id',
            'member_id',
            'min_money',
            'total_invest_money',
            'discount_rate',
            'status',
            'verify_user',
            'verify_date',
            'counter_fee',
            'create_time:datetime',
            'update_time:datetime',
            'is_delete',
        ],
    ]) ?>

</div>
