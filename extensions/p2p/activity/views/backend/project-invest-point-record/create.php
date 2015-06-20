<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model p2p\activity\models\ProjectInvestPointRecord */

$this->title = Yii::t('p2p_activity', 'Create Project Invest Point Record');
$this->params['breadcrumbs'][] = ['label' => Yii::t('p2p_activity', 'Project Invest Point Records'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="project-invest-point-record-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
