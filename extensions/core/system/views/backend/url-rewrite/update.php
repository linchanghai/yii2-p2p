<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model core\system\models\UrlRewrite */

$this->title = Yii::t('core_system', 'Update {modelClass}: ', [
    'modelClass' => 'Url Rewrite',
]) . ' ' . $model->url_rewrite_id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('core_system', 'Url Rewrites'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->url_rewrite_id, 'url' => ['view', 'id' => $model->url_rewrite_id]];
$this->params['breadcrumbs'][] = Yii::t('core_system', 'Update');
?>
<div class="url-rewrite-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
