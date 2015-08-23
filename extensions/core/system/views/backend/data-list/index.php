<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataList core\system\models\DataListModel */
/* @var $type string */

$this->title = Yii::t('core_system', 'Data Lists');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="data-list-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $dataList->renderIndex($type) ?>

</div>
