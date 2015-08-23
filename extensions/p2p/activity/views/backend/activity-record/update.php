<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model p2p\activity\models\ActivityRecord */

$this->title = Yii::t('p2p_activity', 'Update {modelClass}: ', [
    'modelClass' => 'Activity Record',
]) . ' ' . $model->activity_records_id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('p2p_activity', 'Activity Records'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->activity_records_id, 'url' => ['view', 'id' => $model->activity_records_id]];
$this->params['breadcrumbs'][] = Yii::t('p2p_activity', 'Update');
?>
<div class="activity-record-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
