<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model p2p\activity\models\ActivityRecord */

$this->title = Yii::t('p2p_activity', 'Create Activity Record');
$this->params['breadcrumbs'][] = ['label' => Yii::t('p2p_activity', 'Activity Records'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="activity-record-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
