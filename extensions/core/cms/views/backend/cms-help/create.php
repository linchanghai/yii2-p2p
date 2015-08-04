<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model core\cms\models\CmsHelp */

$this->title = Yii::t('core_cms', 'Create Cms Help');
$this->params['breadcrumbs'][] = ['label' => Yii::t('core_cms', 'Cms Helps'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cms-help-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
