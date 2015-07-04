<?php

use yii\helpers\Html;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel p2p\activity\searches\CouponAnnualRecordSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('p2p_activity', 'Coupon Annual Records');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="coupon-annual-record-index">


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
                'label'=>Yii::t('p2p_activity', 'Type'),
                'attribute'=>'coupon_annual_record_id',
                'vAlign'=>'middle',
                'width'=>'180px',
                'value'=>function ($model, $key, $index, $widget) {
                    return '年化券';
                },
            ],
            [
                'attribute'=>'rate',
                'vAlign'=>'middle',
                'width'=>'180px',
                'value'=>function ($model) {
                    return $model->rate."%";
                },
            ],

            'project.project_name',
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
//            'member_coupon_id',
             'interst_money',
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
