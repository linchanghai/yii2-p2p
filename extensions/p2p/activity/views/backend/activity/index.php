<?php

use kiwi\Kiwi;
use yii\helpers\Html;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel p2p\activity\searches\ActivitySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('p2p_activity', 'Activities');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="activity-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

//            'activity_id',
            [
                'attribute' => 'activity_type',
                'vAlign' => 'middle',
                'width' => '180px',
                'value' => function ($model, $key, $index, $widget) {
                    /** @var \p2p\activity\models\Activity $model */
                    return Yii::$app->dataList->activityTypes[$model->activity_type];
                },
                'filterType' => GridView::FILTER_SELECT2,
                'filter' => Yii::$app->dataList->activityTypes,
                'filterWidgetOptions' => [
                    'pluginOptions' => ['allowClear' => true],
                ],
                'filterInputOptions' => ['placeholder' => 'Any Type'],
                'format' => 'raw'
            ],
            [
                'attribute' => 'activity_send_type',
                'vAlign' => 'middle',
                'width' => '180px',
                'value' => function ($model, $key, $index, $widget) {
                    /** @var \p2p\activity\models\Activity $model */
                    return Yii::$app->dataList->activitySendTypes[$model->activity_send_type];
                },
                'filterType' => GridView::FILTER_SELECT2,
                'filter' => Yii::$app->dataList->activitySendTypes,
                'filterWidgetOptions' => [
                    'pluginOptions' => ['allowClear' => true],
                ],
                'filterInputOptions' => ['placeholder' => 'Any Type'],
                'format' => 'raw'
            ],
            'activity_send_value',
            'valid_date',
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
        'toolbar' => Html::a(Yii::t('p2p_activity', 'Create Activity'), ['create'], ['class' => 'btn btn-info']),
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
