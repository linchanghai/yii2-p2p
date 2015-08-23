<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model p2p\activity\models\CouponBonusRecord */

$this->title = Yii::t('p2p_activity', 'Create Coupon Bonus Record');
$this->params['breadcrumbs'][] = ['label' => Yii::t('p2p_activity', 'Coupon Bonus Records'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="coupon-bonus-record-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
