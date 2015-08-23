<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->params['breadcrumbs'][] = $this->title;
$options = isset($options) ? $options : [
    'draggable' => true,
    'manyroots' => true,
];
?>
<div class="tree-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('@vendor/gilek/yii2-gtreetable/views/widget', ['options' => $options]); ?>
</div>
