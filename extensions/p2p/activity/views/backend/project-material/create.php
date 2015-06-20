<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model p2p\activity\models\ProjectMaterial */

$this->title = Yii::t('p2p_activity', 'Create Project Material');
$this->params['breadcrumbs'][] = ['label' => Yii::t('p2p_activity', 'Project Materials'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="project-material-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
