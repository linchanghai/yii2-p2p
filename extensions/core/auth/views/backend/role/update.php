<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model core\auth\models\RoleModel */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => Yii::t('app', 'Role'),
]) . ' ' . $model->description;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Role List'), 'url' => ['index']];
//$this->params['breadcrumbs'][] = ['label' => $model->description, 'url' => ['view', 'id' => $model->description]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
$this->params['topMenuKey'] = 'system';
$this->params['leftMenuKey'] = 'role';
?>
<div class="role-update">

    <h2><?= Html::encode($this->title) ?></h2>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
