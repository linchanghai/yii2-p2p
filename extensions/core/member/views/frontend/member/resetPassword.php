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
<div class="containerMain">

    <ul class="clearFix rechargeTitle">
        <li><a class="active" href="#">修改密码</a></li>
    </ul>
    <div class="backGrey p20 ">
        <div  style="width: 500px;margin: auto;margin-top: 20px">
            <?php $form = ActiveForm::begin(['method' => 'post']); ?>
            <div class="formGroup clearFix">
                <label class="fl glyphicon glyphicon-lock inputGroupAdd" for="username"></label>
                <?= $form->field($model, 'old_password')->passwordInput(['class' => "fl formControl", 'placeholder' => "旧密码"])->label(false) ?>

            </div>
            <div class="formGroup mt20 clearFix">
                <label class="fl glyphicon glyphicon-lock inputGroupAdd" for="username"></label>
                <?= $form->field($model, 'new_password')->passwordInput(['class' => "fl formControl", 'placeholder' => "请输入密码"])->label(false) ?>
            </div>
            <div class="formGroup mt20 clearFix">
                <label class="fl glyphicon glyphicon-lock inputGroupAdd" for="username"></label>
                <?= $form->field($model, 'confirm_password')->passwordInput(['class' => "fl formControl", 'placeholder' => "请输入密码"])->label(false) ?>
            </div>
            <div class="formGroup mt20 clearFix">
                <?= Html::submitButton('修改密码', ['class' => 'secondBtn largeBtn loginBtn']) ?>
            </div>
            <?php ActiveForm::end(); ?>
        </div>

    </div>

</div>