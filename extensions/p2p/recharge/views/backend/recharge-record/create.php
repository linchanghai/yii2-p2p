<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model p2p\recharge\models\RechargeRecord */

$this->title = Yii::t('p2p_recharge', 'Create Recharge Record');
$this->params['breadcrumbs'][] = ['label' => Yii::t('p2p_recharge', 'Recharge Records'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="recharge-record-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
