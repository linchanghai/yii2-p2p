<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model core\cms\models\CmsHelp */

$this->title = Yii::t('core_cms', 'Update {modelClass}: ', [
    'modelClass' => 'Cms Help',
]) . ' ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('core_cms', 'Cms Helps'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->cms_help_id]];
$this->params['breadcrumbs'][] = Yii::t('core_cms', 'Update');
?>
<div class="cms-help-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
