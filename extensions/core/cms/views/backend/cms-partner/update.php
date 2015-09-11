<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model core\cms\models\CmsPartner */

$this->title = Yii::t('core_cms', 'Update {modelClass}: ', [
    'modelClass' => 'Cms Partner',
]) . ' ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('core_cms', 'Cms Partners'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->cms_partner_id]];
$this->params['breadcrumbs'][] = Yii::t('core_cms', 'Update');
?>
<div class="cms-partner-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
