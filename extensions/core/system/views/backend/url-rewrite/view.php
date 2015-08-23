<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model core\system\models\UrlRewrite */

$this->title = $model->url_rewrite_id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('core_system', 'Url Rewrites'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="url-rewrite-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('core_system', 'Update'), ['update', 'id' => $model->url_rewrite_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('core_system', 'Delete'), ['delete', 'id' => $model->url_rewrite_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('core_system', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'url_rewrite_id:url',
            'request_path',
            'route',
            'params',
        ],
    ]) ?>

</div>
