<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model core\notification\searches\NotificationTemplateSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="notification-template-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'notification_template_id') ?>

    <?= $form->field($model, 'event') ?>

    <?= $form->field($model, 'type') ?>

    <?= $form->field($model, 'title') ?>

    <?= $form->field($model, 'template') ?>

    <?php // echo $form->field($model, 'receiver') ?>

    <?php // echo $form->field($model, 'active') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('core_notification', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('core_notification', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
