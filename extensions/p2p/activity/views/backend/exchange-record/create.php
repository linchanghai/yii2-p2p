<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model p2p\activity\models\ExchangeRecord */

$this->title = Yii::t('p2p_activity', 'Create Exchange Record');
$this->params['breadcrumbs'][] = ['label' => Yii::t('p2p_activity', 'Exchange Records'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="exchange-record-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
