<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\SignupForm */

$this->title = 'Signup';
$this->params['breadcrumbs'][] = $this->title;
$this->registerCssFile(Yii::$app->urlManager->baseUrl . '/css/account.min.css', ['depends' => [\frontend\assets\AppAsset::className()]]);
?>
<div class="container backGrey loginWrap">
    <div class="clearFix">
        <div class="fr fs16">已有帐号? <a href="<?= Url::to(['/site/login'])?>" class="secondColor">立即登录</a></div>
    </div>
    <?php $form = ActiveForm::begin(['id' => 'form-signup','method'=>'post','class'=>'registerForm']); ?>
        <div class="formGroup clearFix">
            <label class="fl glyphicon glyphicon-user inputGroupAdd" for="username"></label>
            <?= $form->field($model, 'username')->textInput(['class'=>'fl formControl','placeholder'=>'用户名'])->label(false) ?>
        </div>
        <div class="formGroup mt20 clearFix">
            <label class="fl glyphicon glyphicon-lock inputGroupAdd" for="password"></label>
            <?= $form->field($model, 'password')->passwordInput(['class'=>'fl formControl','placeholder'=>'请输入密码'])->label(false) ?>
        </div>
        <div class="formGroup mt20 clearFix">
            <label class="fl glyphicon glyphicon-phone inputGroupAdd" for="phone"></label>
            <?= $form->field($model, 'email')->textInput(['class'=>'fl formControl','placeholder'=>'请输入邮箱'])->label(false) ?>
        </div>
        <div class="formGroup mt20 clearFix">
            <?= Html::submitButton('立即注册', ['class' => 'secondBtn largeBtn loginBtn']) ?>
        </div>

    <?php ActiveForm::end(); ?>
</div>
