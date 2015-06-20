<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model p2p\activity\models\ProjectMaterial */

$this->title = Yii::t('p2p_activity', 'Update {modelClass}: ', [
    'modelClass' => 'Project Material',
]) . ' ' . $model->project_material;
$this->params['breadcrumbs'][] = ['label' => Yii::t('p2p_activity', 'Project Materials'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->project_material, 'url' => ['view', 'id' => $model->project_material]];
$this->params['breadcrumbs'][] = Yii::t('p2p_activity', 'Update');
?>
<div class="project-material-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
