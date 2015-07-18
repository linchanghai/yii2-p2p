<?php
use kartik\form\ActiveForm;
use yii\helpers\Html;
use yii\helpers\Url;

list($path, $link) = $this->getAssetManager()->publish('@core/member/web/js');
$this->registerJsFile($link . '/email.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
?>
<div class="member-form">

    <?php $form = ActiveForm::begin([
        'id' => 'member-form-horizontal',
        'type' => ActiveForm::TYPE_HORIZONTAL,
        'formConfig' => ['labelSpan' => 2],
        'fullSpan' => 11
    ]); ?>

    <?= $form->field($model, 'mobile')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'code')->textInput(['maxlength' => true]) ?>
    <label class="control-label">
        <button type="button" class="btn btn-primary" id="send-code"
                data-url="<?= Url::to(['/member/member/send-mobile-code']); ?>">获取验证码
        </button>
    </label>
    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-9">
            <?= Html::submitButton( Yii::t('core_member', 'Bind Email Account') , ['class' =>  'btn btn-success' ]) ?>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>
