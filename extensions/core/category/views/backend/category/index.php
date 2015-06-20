<?php

use yii\bootstrap\Modal;
use yii\helpers\Url;
use yii\web\JsExpression;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Categories');

$options = [
    'draggable' => true,
    'manyroots' => true,
    'actions' => [
        [
            'name' => 'Update Detail',
            'event' => new JsExpression("function(oNode, oManager) {
                $('#category-form-modal .modal-body').load('".Url::to(['/core_category/category/update'])."?id=' + oNode.id);
                $('#category-form-modal').modal();
            }")
        ]
    ]
];

echo $this->render('@core/tree/views/tree/index', ['options' => $options]);

Modal::begin([
    'header' => Yii::t('app', 'Update Category'),
    'options' => ['id' => 'category-form-modal']
]);
Modal::end();