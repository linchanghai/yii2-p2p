<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model p2p\activity\models\ProductMap */

$this->title = Yii::t('p2p_activity', 'Update {modelClass}: ', [
    'modelClass' => 'Product Map',
]) . ' ' . $model->product_map_id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('p2p_activity', 'Product Maps'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->product_map_id, 'url' => ['view', 'id' => $model->product_map_id]];
$this->params['breadcrumbs'][] = Yii::t('p2p_activity', 'Update');
?>
<div class="product-map-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
