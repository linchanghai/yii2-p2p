<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model core\system\models\UrlRewrite */

$this->title = Yii::t('core_system', 'Create Url Rewrite');
$this->params['breadcrumbs'][] = ['label' => Yii::t('core_system', 'Url Rewrites'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="url-rewrite-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
