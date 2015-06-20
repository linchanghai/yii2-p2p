<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model p2p\activity\models\ProjectInvestPointRecord */

$this->title = Yii::t('p2p_activity', 'Update {modelClass}: ', [
    'modelClass' => 'Project Invest Point Record',
]) . ' ' . $model->project_invest_point_record;
$this->params['breadcrumbs'][] = ['label' => Yii::t('p2p_activity', 'Project Invest Point Records'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->project_invest_point_record, 'url' => ['view', 'id' => $model->project_invest_point_record]];
$this->params['breadcrumbs'][] = Yii::t('p2p_activity', 'Update');
?>
<div class="project-invest-point-record-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
