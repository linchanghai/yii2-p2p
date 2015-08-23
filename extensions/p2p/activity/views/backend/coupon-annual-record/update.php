<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model p2p\activity\models\CouponAnnualRecord */

$this->title = Yii::t('p2p_activity', 'Update {modelClass}: ', [
    'modelClass' => 'Coupon Annual Record',
]) . ' ' . $model->coupon_annual_record_id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('p2p_activity', 'Coupon Annual Records'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->coupon_annual_record_id, 'url' => ['view', 'id' => $model->coupon_annual_record_id]];
$this->params['breadcrumbs'][] = Yii::t('p2p_activity', 'Update');
?>
<div class="coupon-annual-record-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
