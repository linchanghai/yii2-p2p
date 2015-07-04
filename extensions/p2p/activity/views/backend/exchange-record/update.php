<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model p2p\activity\models\ExchangeRecord */

$this->title = Yii::t('p2p_activity', 'Update {modelClass}: ', [
    'modelClass' => 'Exchange Record',
]) . ' ' . $model->exchange_records_id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('p2p_activity', 'Exchange Records'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->exchange_records_id, 'url' => ['view', 'id' => $model->exchange_records_id]];
$this->params['breadcrumbs'][] = Yii::t('p2p_activity', 'Update');
?>
<div class="exchange-record-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
