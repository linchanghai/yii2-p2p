<?php
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
?>
<div class="containerMain backGrey">
    <div class="itemTitle">
        实名认证
    </div>
        <div  style="width: 450px;margin: auto;margin-top: 20px">
            <?php $form = ActiveForm::begin(['method' => 'post']); ?>
            <div class="formGroup clearFix">
                <label class="fl glyphicon glyphicon-user inputGroupAdd" for="username"></label>
                <?= $form->field($model, 'real_name')->textInput(['class' => "fl formControl", 'placeholder' => "真实姓名"])->label(false) ?>

            </div>
            <div class="formGroup mt20 clearFix">
                <label class="fl glyphicon glyphicon-lock inputGroupAdd" for="username"></label>
                <?= $form->field($model, 'id_card')->textInput(['class' => "fl formControl", 'placeholder' => "卡号"])->label(false) ?>
            </div>
            <div class="formGroup mt20 clearFix">
                <?= Html::submitButton('保存', ['class' => 'secondBtn largeBtn loginBtn']) ?>
            </div>
            <?php ActiveForm::end(); ?>
        </div>
</div>