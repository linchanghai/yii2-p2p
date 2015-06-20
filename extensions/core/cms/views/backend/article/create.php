<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model core\cms\models\Article */

$this->title = Yii::t('core_cms', 'Create Article');
$this->params['breadcrumbs'][] = ['label' => Yii::t('core_cms', 'Articles'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="article-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
