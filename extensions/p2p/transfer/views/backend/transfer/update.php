<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model p2p\transfer\models\ProjectInvestTransferApply */

$this->title = Yii::t('p2p_transfer', 'Update {modelClass}: ', [
        'modelClass' => 'Project Invest Transfer Apply',
    ]) . ' ' . $model->project_invest_transfer_apply_id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('p2p_transfer', 'Project Invest Transfer Applies'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->project_invest_transfer_apply_id];
$this->params['breadcrumbs'][] = Yii::t('p2p_transfer', 'Update');
?>
<div class="project-invest-transfer-apply-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
