<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model p2p\activity\models\CouponBonusRecord */

$this->title = Yii::t('p2p_activity', 'Update {modelClass}: ', [
    'modelClass' => 'Coupon Bonus Record',
]) . ' ' . $model->coupon_bonus_record_id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('p2p_activity', 'Coupon Bonus Records'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->coupon_bonus_record_id, 'url' => ['view', 'id' => $model->coupon_bonus_record_id]];
$this->params['breadcrumbs'][] = Yii::t('p2p_activity', 'Update');
?>
<div class="coupon-bonus-record-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
