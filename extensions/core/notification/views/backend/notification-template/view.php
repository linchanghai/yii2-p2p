<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model core\notification\models\NotificationTemplate */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('core_notification', 'Notification Templates'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="notification-template-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('core_notification', 'Update'), ['update', 'id' => $model->notification_template_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('core_notification', 'Delete'), ['delete', 'id' => $model->notification_template_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('core_notification', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'notification_template_id',
            'event',
            'type',
            'title',
            'template',
            'receiver',
            'active',
        ],
    ]) ?>

</div>
