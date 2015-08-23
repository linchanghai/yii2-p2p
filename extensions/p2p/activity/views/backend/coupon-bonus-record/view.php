<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model p2p\activity\models\CouponBonusRecord */

$this->title = $model->coupon_bonus_record_id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('p2p_activity', 'Coupon Bonus Records'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="coupon-bonus-record-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('p2p_activity', 'Update'), ['update', 'id' => $model->coupon_bonus_record_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('p2p_activity', 'Delete'), ['delete', 'id' => $model->coupon_bonus_record_id], [
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
            'coupon_bonus_record_id',
            'project_invest_id',
            'project_id',
            'member_id',
            'discount_money',
            'create_time:datetime',
            'is_delete',
        ],
    ]) ?>

</div>
