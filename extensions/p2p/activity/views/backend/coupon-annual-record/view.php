<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model p2p\activity\models\CouponAnnualRecord */

$this->title = $model->coupon_annual_record_id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('p2p_activity', 'Coupon Annual Records'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="coupon-annual-record-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('p2p_activity', 'Update'), ['update', 'id' => $model->coupon_annual_record_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('p2p_activity', 'Delete'), ['delete', 'id' => $model->coupon_annual_record_id], [
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
            'coupon_annual_record_id',
            'project_invest_id',
            'project_id',
            'member_id',
            'member_coupon_id',
            'rate',
            'interst_money',
            'create_time:datetime',
            'is_delete',
        ],
    ]) ?>

</div>
