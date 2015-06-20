<?php

use yii\bootstrap\Modal;
use yii\helpers\Url;
use yii\web\JsExpression;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Menus');

$options = [
    'draggable' => true,
    'manyroots' => true,
    'actions' => [
        [
            'name' => 'Update Detail',
            'event' => new JsExpression("function(oNode, oManager) {
                $('#menu-form-modal .modal-body').load('".Url::to(['/core_system/menu/update'])."?id=' + oNode.id);
                $('#menu-form-modal').modal();
            }")
        ]
    ]
];

echo $this->render('@core/tree/views/tree/index', ['options' => $options]);

Modal::begin([
    'header' => Yii::t('app', 'Update Menu'),
    'options' => ['id' => 'menu-form-modal']
]);
Modal::end();