<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model core\system\searches\UrlRewriteSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="url-rewrite-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'url_rewrite_id') ?>

    <?= $form->field($model, 'request_path') ?>

    <?= $form->field($model, 'route') ?>

    <?= $form->field($model, 'params') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('core_system', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('core_system', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
