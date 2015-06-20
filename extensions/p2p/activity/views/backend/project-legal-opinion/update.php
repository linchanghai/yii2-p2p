<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model p2p\activity\models\ProjectLegalOpinion */

$this->title = Yii::t('p2p_activity', 'Update {modelClass}: ', [
    'modelClass' => 'Project Legal Opinion',
]) . ' ' . $model->project_legal_opinion_id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('p2p_activity', 'Project Legal Opinions'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->project_legal_opinion_id, 'url' => ['view', 'id' => $model->project_legal_opinion_id]];
$this->params['breadcrumbs'][] = Yii::t('p2p_activity', 'Update');
?>
<div class="project-legal-opinion-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
