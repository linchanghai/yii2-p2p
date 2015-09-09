<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model core\cms\models\CmsNotice */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('core_cms', 'Cms Notices'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cms-notice-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('core_cms', 'Update'), ['update', 'id' => $model->cms_notice_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('core_cms', 'Delete'), ['delete', 'id' => $model->cms_notice_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('core_cms', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'cms_notice_id',
            'type',
            'img',
            'title',
            'content:ntext',
            'create_time:datetime',
            'update_time:datetime',
            'publihser_date',
            'create_by',
            'update_by',
            'is_delete',
        ],
    ]) ?>

</div>
