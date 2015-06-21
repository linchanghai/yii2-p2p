<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model p2p\activity\models\ProjectRepayment */

$this->title = Yii::t('p2p_activity', 'Create Project Repayment');
$this->params['breadcrumbs'][] = ['label' => Yii::t('p2p_activity', 'Project Repayments'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="project-repayment-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
