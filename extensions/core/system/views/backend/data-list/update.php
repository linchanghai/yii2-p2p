<?php

use kiwi\Kiwi;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model core\system\models\DataList */

$dataList = Yii::$app->dataList;
$type = $dataList->getDataList($model->type)[$dataList->labelKey];

$this->title = Yii::t('core_system', 'Update {type} Value: ', [
    'type' => $type,
]) . ' ' . $model->key;
$this->params['breadcrumbs'][] = ['label' => Yii::t('core_system', 'Data Lists'), 'url' => ['index']];
//$this->params['breadcrumbs'][] = ['label' => $model->key, 'url' => ['view', 'id' => $model->data_list_id]];
$this->params['breadcrumbs'][] = Yii::t('core_system', 'Update');
?>
<div class="data-list-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
