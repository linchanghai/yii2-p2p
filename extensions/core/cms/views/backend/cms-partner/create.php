<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model core\cms\models\CmsPartner */

$this->title = Yii::t('core_cms', 'Create Cms Partner');
$this->params['breadcrumbs'][] = ['label' => Yii::t('core_cms', 'Cms Partners'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cms-partner-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
