<?php

use yii\helpers\Html;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('p2p_activity', 'Product Maps');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-map-index">

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

//            'product_map_id',
            [
                'attribute'=>'type',
                'vAlign'=>'middle',
                'width'=>'180px',
                'value'=>function ($model, $key, $index, $widget) {
                    $productModel = \kiwi\Kiwi::getProductMap()->findOne($model->product_map_id);
                    $status = $productModel->getTypeArray();
                    return $status[$productModel->type];
                },
                'filterType'=>GridView::FILTER_SELECT2,
                'filter'=>[ 1 => Yii::t('p2p_activity', 'Coupon Bonus'),
                    2 => Yii::t('p2p_activity', 'Coupon Cash'),
                    3 => Yii::t('p2p_activity', 'Coupon Annual'),],
                'filterWidgetOptions'=>[
                    'pluginOptions'=>['allowClear'=>true],
                ],
                'filterInputOptions'=>['placeholder'=>'Any Type'],
                'format'=>'raw'
            ],
            'exchange_value',
            'exchange_points',
            [
                'attribute'=>'duration',
                'vAlign'=>'middle',
                'width'=>'180px',
                'value'=>function ($model, $key, $index, $widget) {
                    return $model->duration.'天';
                }
            ],
             'create_time:datetime',
             'update_time:datetime',
            // 'is_delete',

            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '<div style="width: 30px">{update} {delete}</div>'
            ],
        ],
        'export' => false,
        'responsive' => true,
        'toolbar' => Html::a(Yii::t('p2p_activity', 'Create Product'), ['create'], ['class' => 'btn btn-info']),
        'containerOptions' => ['style' => 'overflow: auto'], // only set when $responsive = false
        'headerRowOptions' => ['class' => 'kartik-sheet-style'],
        'filterRowOptions' => ['class' => 'kartik-sheet-style'],
        'panelHeadingTemplate' => '<h3 class="panel-title"><i class="glyphicon glyphicon-globe"></i> ' . Html::encode($this->title) . '</h3>',
        'panel' => [
            'type' => GridView::TYPE_DEFAULT,
//            'before' => Html::a(Yii::t('p2p_project', 'Create Project'), ['create'], ['class' => 'btn btn-info']),
            'after' => false,
            'footer' => false
        ],
    ]); ?>



</div>
