<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model p2p\project\models\Project */

$this->title = Yii::t('p2p_project', 'Update {modelClass}: ', [
    'modelClass' => 'Project',
]) . ' ' . $model->project_id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('p2p_project', 'Projects Check'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->project_name];
$this->params['breadcrumbs'][] = Yii::t('p2p_project', 'Update');
?>
<div class="project-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
