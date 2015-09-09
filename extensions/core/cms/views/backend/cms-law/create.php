<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model core\cms\models\CmsLaw */

$this->title = Yii::t('core_cms', 'Create Cms Law');
$this->params['breadcrumbs'][] = ['label' => Yii::t('core_cms', 'Cms Laws'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cms-law-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
