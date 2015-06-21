<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model p2p\activity\models\ProjectInvest */

$this->title = Yii::t('p2p_activity', 'Update {modelClass}: ', [
    'modelClass' => 'Project Invest',
]) . ' ' . $model->project_invest_id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('p2p_activity', 'Project Invests'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->project_invest_id, 'url' => ['view', 'id' => $model->project_invest_id]];
$this->params['breadcrumbs'][] = Yii::t('p2p_activity', 'Update');
?>
<div class="project-invest-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
