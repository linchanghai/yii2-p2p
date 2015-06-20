<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model p2p\activity\models\ProjectLegalOpinion */

$this->title = Yii::t('p2p_activity', 'Create Project Legal Opinion');
$this->params['breadcrumbs'][] = ['label' => Yii::t('p2p_activity', 'Project Legal Opinions'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="project-legal-opinion-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
