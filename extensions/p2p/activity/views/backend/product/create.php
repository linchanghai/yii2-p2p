<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model p2p\activity\models\ProductMap */

$this->title = Yii::t('p2p_activity', 'Create Product Map');
$this->params['breadcrumbs'][] = ['label' => Yii::t('p2p_activity', 'Product Maps'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-map-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
