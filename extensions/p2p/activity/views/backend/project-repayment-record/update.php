<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model p2p\activity\models\ProjectRepaymentRecord */

$this->title = Yii::t('p2p_activity', 'Update {modelClass}: ', [
    'modelClass' => 'Project Repayment Record',
]) . ' ' . $model->project_repayment_record;
$this->params['breadcrumbs'][] = ['label' => Yii::t('p2p_activity', 'Project Repayment Records'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->project_repayment_record, 'url' => ['view', 'id' => $model->project_repayment_record]];
$this->params['breadcrumbs'][] = Yii::t('p2p_activity', 'Update');
?>
<div class="project-repayment-record-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
