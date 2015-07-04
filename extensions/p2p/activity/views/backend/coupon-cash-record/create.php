<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model p2p\activity\models\CouponCashRecord */

$this->title = Yii::t('p2p_activity', 'Create Coupon Cash Record');
$this->params['breadcrumbs'][] = ['label' => Yii::t('p2p_activity', 'Coupon Cash Records'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="coupon-cash-record-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
