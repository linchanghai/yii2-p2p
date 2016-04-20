<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model core\auth\models\RoleModel */
/* @var $form yii\bootstrap\ActiveForm */

$js = <<<EOF
    $('.panel-body .control-label').click(function() {
        if ($(this).parent().find('[type=checkbox]:checked').length == $(this).parent().find('[type=checkbox]').length) {
            $(this).parent().find('[type=checkbox]').prop('checked', false);
        } else {
            $(this).parent().find('[type=checkbox]').prop('checked', true);
        }
    });

    $('.panel-heading').click(function() {
        if ($(this).parent().find('[type=checkbox]:checked').length == $(this).parent().find('[type=checkbox]').length) {
            $(this).parent().find('[type=checkbox]').prop('checked', false);
        } else {
            $(this).parent().find('[type=checkbox]').prop('checked', true);
        }
    });
EOF;
$this->registerJs($js);
?>

<div class="role-form">
    <?php
    $template = "{label}\n<div class=\"col-sm-11\">{input}\n{hint}\n{error}</div>";
    $labelOptions = ['class' => 'control-label col-sm-1', 'style' => 'cursor: pointer'];
    $options = ['template' => $template, 'labelOptions' => $labelOptions];

    $form = ActiveForm::begin(['options' => ['class' => 'form-horizontal']]);
    echo $form->field($model, 'description', $options);
    echo Html::tag('div', '', ['class' => 'clearfix']);
    $template = "{label}\n<div class=\"col-sm-10\">{input}\n{hint}\n{error}</div>";
    $labelOptions = ['class' => 'control-label col-sm-2', 'style' => 'cursor: pointer'];
    $options = ['template' => $template, 'labelOptions' => $labelOptions];
    $groups = $model->renderForm($form, $options);
    ?>
    <div class="form-group">
        <label class="col-sm-1 control-label"><?= Yii::t('core_auth', 'Permission List') ?></label>

        <div class="col-sm-11">
            <?php
            foreach ($groups as $key => $labelContent) {
                ?>
                <div class="panel panel-default">
                    <div class="panel-heading" style="cursor: pointer;"><?= $labelContent['label'] ?>[<?= Yii::t('core_auth', 'Select All') ?>]</div>
                    <div class="panel-body">
                        <?= $labelContent['content'] ?>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-offset-1 col-sm-11">
            <?= Html::submitButton($model->isNewRecord ? Yii::t('core_auth', 'Create') : Yii::t('core_auth', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>
    </div>
    <?php $form->end(); ?>
</div>
<script type="text/javascript"></script>