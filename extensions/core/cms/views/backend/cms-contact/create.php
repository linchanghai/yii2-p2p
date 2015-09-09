<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model core\cms\models\CmsContact */

$this->title = Yii::t('core_cms', 'Create Cms Contact');
$this->params['breadcrumbs'][] = ['label' => Yii::t('core_cms', 'Cms Contacts'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cms-contact-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
