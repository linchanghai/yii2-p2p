<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model core\auth\models\User */

$this->title = Yii::t('app', 'Create {modelClass}', [
    'modelClass' => Yii::t('app', 'Administrator'),
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Administrator'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$this->params['topMenuKey'] = 'system';
$this->params['leftMenuKey'] = 'user';
?>
<div class="user-create">

    <h2><?= Html::encode($this->title) ?></h2>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
