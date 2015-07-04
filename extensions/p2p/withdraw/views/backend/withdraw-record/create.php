<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model p2p\withdraw\models\WithdrawRecord */

$this->title = Yii::t('p2p_withdraw', 'Create Withdraw Record');
$this->params['breadcrumbs'][] = ['label' => Yii::t('p2p_withdraw', 'Withdraw Records'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="withdraw-record-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
