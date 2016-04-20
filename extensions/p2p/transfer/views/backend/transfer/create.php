<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model p2p\transfer\models\ProjectInvestTransferApply */

$this->title = Yii::t('p2p_transfer', 'Create Project Invest Transfer Apply');
$this->params['breadcrumbs'][] = ['label' => Yii::t('p2p_transfer', 'Project Invest Transfer Applies'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="project-invest-transfer-apply-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
