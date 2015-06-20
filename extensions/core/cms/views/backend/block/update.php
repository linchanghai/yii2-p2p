<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model core\cms\models\Block */

$this->title = Yii::t('core_cms', 'Update {modelClass}: ', [
    'modelClass' => 'Block',
]) . ' ' . $model->block_id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('core_cms', 'Blocks'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->block_id, 'url' => ['view', 'id' => $model->block_id]];
$this->params['breadcrumbs'][] = Yii::t('core_cms', 'Update');
?>
<div class="block-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
