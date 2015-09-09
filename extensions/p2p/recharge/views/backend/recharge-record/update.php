<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model p2p\recharge\models\RechargeRecord */

$this->title = Yii::t('p2p_recharge', 'Update {modelClass}: ', [
    'modelClass' => 'Recharge Record',
]) . ' ' . $model->recharge_record_id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('p2p_recharge', 'Recharge Records'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->recharge_record_id, 'url' => ['view', 'id' => $model->recharge_record_id]];
$this->params['breadcrumbs'][] = Yii::t('p2p_recharge', 'Update');
?>
<div class="recharge-record-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
