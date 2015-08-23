<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model p2p\activity\models\Activity */

$this->title = Yii::t('p2p_activity', 'Create Activity');
$this->params['breadcrumbs'][] = ['label' => Yii::t('p2p_activity', 'Activities'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="activity-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
