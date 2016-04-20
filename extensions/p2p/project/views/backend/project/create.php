<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model p2p\project\models\Project */

$this->title = Yii::t('p2p_project', 'Create Project');
$this->params['breadcrumbs'][] = ['label' => Yii::t('p2p_project', 'Projects'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="project-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
