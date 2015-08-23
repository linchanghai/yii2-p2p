<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

$this->registerCssFile(Yii::$app->urlManager->baseUrl . '/css/account.min.css', ['depends' => [\frontend\assets\AppAsset::className()]]);

$this->registerJsFile(Yii::$app->urlManager->baseUrl . '/js/account.js', ['depends' => [\frontend\assets\AppAsset::className()]]);

?>
<div class="container backGrey loginWrap">
    <div class="clearFix">
        <div class="fr fs16">没有帐号? <a href="<?= \yii\helpers\Url::to(['/site/signup'])?>" class="secondColor">立即注册</a></div>
    </div>
    <?php $form = ActiveForm::begin(['method'=>'post']); ?>
        <div class="formGroup clearFix">
            <label class="fl glyphicon glyphicon-user inputGroupAdd" for="username"></label>
            <?= $form->field($model, 'username')->textInput(['class'=>"fl formControl",'placeholder'=>"用户名"])->label(false)?>

        </div>
        <div class="formGroup mt20 clearFix">
            <label class="fl glyphicon glyphicon-lock inputGroupAdd" for="username"></label>
            <?= $form->field($model, 'password')->passwordInput(['class'=>"fl formControl",'placeholder'=>"请输入密码"])->label(false) ?>
        </div>
        <div class="formGroup mt20 clearFix">
            <label class="fl rememberMe" for="rememberMe"><input type="checkbox" class="prt2" id="rememberMe" name="LoginForm[rememberMe]" value=1 checked>记住我</label>
            <a class="fl findPasswordLink themeColor">忘记密码?</a>
        </div>
        <div class="formGroup mt20 clearFix">
            <?= Html::submitButton('立即登录', ['class' => 'secondBtn largeBtn loginBtn']) ?>
        </div>
        <div class="formGroup mt20">
            <i class="glyphicon glyphicon-ok-sign secondColor"></i>您的信息已使用SSL加密技术，数据传输安全
        </div>
    <?php ActiveForm::end(); ?>
</div>
