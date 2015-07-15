<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model p2p\withdraw\models\WithdrawRecord */

$this->title = Yii::t('p2p_withdraw', 'Update {modelClass}: ', [
    'modelClass' => 'Withdraw Record',
]) . ' ' . $model->deposit_record_id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('p2p_withdraw', 'Withdraw Records'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->deposit_record_id];
$this->params['breadcrumbs'][] = Yii::t('p2p_withdraw', 'Update');
?>
<div class="withdraw-record-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
