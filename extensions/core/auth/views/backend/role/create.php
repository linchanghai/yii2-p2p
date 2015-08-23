<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $roleModel core\auth\models\RoleModel */

$this->title = Yii::t('core_auth', 'Create {modelClass}', [
    'modelClass' => Yii::t('core_auth', 'Role'),
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('core_auth', 'Role List'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$this->params['topMenuKey'] = 'system';
$this->params['leftMenuKey'] = 'role';
?>
<div class="role-create">

    <h2><?= Html::encode($this->title) ?></h2>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
