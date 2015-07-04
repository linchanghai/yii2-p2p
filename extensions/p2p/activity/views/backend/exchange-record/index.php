<?php

use yii\helpers\Html;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel p2p\activity\searches\ExchangeRecordSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('p2p_activity', 'Exchange Records');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="exchange-record-index">



    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

//            'exchange_records_id',
            [
                'attribute'=>'member_id',
                'vAlign'=>'middle',
                'width'=>'180px',
                'value'=>function ($model, $key, $index, $widget) {
                    $member = \kiwi\Kiwi::getMember()->findOne($model->member_id);
                    return $member->username;
                      },
                'filterType'=>GridView::FILTER_SELECT2,
                'filter'=>\kiwi\helpers\ArrayHelper::map(\kiwi\Kiwi::getMember()->find()->orderBy('username')->asArray()->all(), 'member_id', 'username'),
                'filterWidgetOptions'=>[
                    'pluginOptions'=>['allowClear'=>true],
                ],
                'filterInputOptions'=>['placeholder'=>'Any author'],
                'format'=>'raw'
            ],
            [
                'label'=> Yii::t('p2p_activity', 'Type'),
                'attribute'=>'product_map_id',
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
            [
                'label'=> Yii::t('p2p_activity', 'Exchange Value'),
                'attribute'=>'note',
                'vAlign'=>'middle',
                'width'=>'180px',
                'value'=>function ($model, $key, $index, $widget) {
                    $productModel = \kiwi\Kiwi::getProductMap()->findOne($model->product_map_id);
                    return $productModel->exchange_value;
                }
            ],
            'note',
            'create_time:datetime',
            // 'is_delete',


        ],
        'export' => false,
        'responsive' => true,
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
