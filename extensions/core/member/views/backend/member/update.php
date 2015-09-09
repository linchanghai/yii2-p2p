<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model core\member\models\Member */

$this->title = Yii::t('core_member', 'Update {modelClass}: ', [
    'modelClass' => 'Member',
]) . ' ' . $model->member_id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('core_member', 'Members'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->member_id, 'url' => ['view', 'id' => $model->member_id]];
$this->params['breadcrumbs'][] = Yii::t('core_member', 'Update');
?>
<div class="member-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
