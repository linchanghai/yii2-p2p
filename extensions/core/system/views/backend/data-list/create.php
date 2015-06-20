<?php

use kiwi\Kiwi;
use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model core\system\models\DataList */

$dataList = Kiwi::getDataListModel();
$type = $dataList->getDataList($model->type)[$dataList->labelKey];

$this->title = Yii::t('core_system', 'Add {type} Value', ['type' => $type]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('core_system', 'Data Lists'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="data-list-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
