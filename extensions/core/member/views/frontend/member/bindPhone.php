<?php
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
use yii\helpers\Url;

list($path, $link) = $this->getAssetManager()->publish('@core/member/web/js');
$this->registerJsFile($link . '/email.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
$cs =<<<CSS
button[disabled]{
background-color: #cccccc;
}
CSS;

$this->registerCss($cs);
?>

<div class="containerMain backGrey">
    <div class="itemTitle">
        绑定手机
    </div>
    <div style="width: 450px;margin: auto;margin-top: 20px">
        <?php $form = ActiveForm::begin(['method' => 'post','options'=>['class'=>'registerForm']]); ?>
        <div class="formGroup mt20 clearFix">
            <label class="fl glyphicon glyphicon-phone inputGroupAdd" for="username"></label>
            <?= $form->field($model, 'mobile')->textInput(['class' => "fl formControl", 'placeholder' => "手机号"])->label(false) ?>

        </div>
        <div class="formGroup formGroupUnion mt20 clearFix">
            <?= $form->field($model, 'code')->textInput(['class' => "fl formControl", 'placeholder' => "输入验证码"])->label(false) ?>
            <button type="button" class="fr itemInput btn secondBtn" id="send-code"  data-url="<?= Url::to(['/member/member/send-mobile-code']); ?>">发送短信验证码</button>
        </div>
        <div class="formGroup mt20 clearFix">
            <?= Html::submitButton('绑定', ['class' => 'secondBtn largeBtn loginBtn']) ?>
        </div>
        <?php ActiveForm::end(); ?>
    </div>
</div>