<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model core\cms\models\CmsContact */

$this->title = Yii::t('core_cms', 'Update {modelClass}: ', [
    'modelClass' => 'Cms Contact',
]) . ' ' . $model->cms_contact_id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('core_cms', 'Cms Contacts'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->cms_contact_id, 'url' => ['view', 'id' => $model->cms_contact_id]];
$this->params['breadcrumbs'][] = Yii::t('core_cms', 'Update');
?>
<div class="cms-contact-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
