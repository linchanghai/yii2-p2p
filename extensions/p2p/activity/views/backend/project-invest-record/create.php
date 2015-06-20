<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model p2p\activity\models\ProjectInvestRecord */

$this->title = Yii::t('p2p_activity', 'Create Project Invest Record');
$this->params['breadcrumbs'][] = ['label' => Yii::t('p2p_activity', 'Project Invest Records'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="project-invest-record-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
