<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model core\auth\models\UserModel */

$this->title = Yii::t('core_auth', 'Update {modelClass}: ', [
    'modelClass' => Yii::t('core_auth', 'Administrator'),
]) . ' ' . $model->user->username;
$this->params['breadcrumbs'][] = ['label' => Yii::t('core_auth', 'Administrator'), 'url' => ['index']];
//$this->params['breadcrumbs'][] = ['label' => $model->user->username, 'url' => ['view', 'id' => $model->user->id]];
$this->params['breadcrumbs'][] = Yii::t('core_auth', 'Update');
$this->params['topMenuKey'] = 'system';
$this->params['leftMenuKey'] = 'user';
?>
<div class="user-update">

    <h2><?= Html::encode($this->title) ?></h2>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
