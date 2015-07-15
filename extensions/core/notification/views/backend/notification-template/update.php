<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model core\notification\models\NotificationTemplate */

$this->title = Yii::t('core_notification', 'Update {modelClass}: ', [
    'modelClass' => 'Notification Template',
]) . ' ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('core_notification', 'Notification Templates'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->notification_template_id]];
$this->params['breadcrumbs'][] = Yii::t('core_notification', 'Update');
?>
<div class="notification-template-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
