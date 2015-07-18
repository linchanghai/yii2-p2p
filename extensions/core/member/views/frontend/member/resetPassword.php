<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\PasswordResetRequestForm */

$this->title = '重置密码';
$this->params['breadcrumbs'] = [
    'title' => '更改密码'
];
?>
<div class="site-request-password-reset">
    <h3 class="breadcrumb" style="text-align: center"><?= Html::encode($this->title) ?></h3>

    <div class="row">
        <div class="col-lg-3"></div>
        <div class="col-lg-6">
            <?php $form = ActiveForm::begin(['id' => 'form-new-password']); ?>
            <?= $form->field($model, 'old_password')->passwordInput() ?>
            <?= $form->field($model, 'new_password')->passwordInput() ?>
            <?= $form->field($model, 'confirm_password')->passwordInput() ?>
            <div class="form-group">
                <?= Html::submitButton('重置', ['class' => 'btn btn-primary', 'name' => 'reset-button']) ?>
            </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
