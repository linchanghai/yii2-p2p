<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model core\notification\models\NotificationTemplate */

$this->title = Yii::t('core_notification', 'Create Notification Template');
$this->params['breadcrumbs'][] = ['label' => Yii::t('core_notification', 'Notification Templates'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="notification-template-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
