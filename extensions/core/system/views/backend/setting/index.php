<?php
/**
 * @author Lujie.Zhou(lujie.zhou@jago-ag.cn) 
 * @Date 6/8/2015
 * @Time 12:30 PM
 */

use yii\bootstrap\ActiveForm;
use yii\helpers\Html;

/* @var $this \yii\web\View */
/* @var $setting \core\system\models\SettingModel */

$this->title = Yii::t('core_system', 'Setting');
$this->params['breadcrumbs'][] = $this->title;
$this->params['topMenuKey'] = 'setting';
$this->params['leftMenuKey'] = 'setting';
?>
<div class="setting-index">
    <h2><?= Html::encode($this->title) ?></h2>
    <?php
    $form = ActiveForm::begin(['options' => ['class' => 'form-horizontal']]);
    echo $setting->renderForm($form);
    echo Html::submitButton(Yii::t('core_system', 'Save'), ['class' => 'btn btn-primary']);
    $form->end();
    ?>
</div>

