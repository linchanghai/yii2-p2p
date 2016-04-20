<?php

use kiwi\Kiwi;
use yii\helpers\Html;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel core\notification\searches\NotificationTemplateSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('core_notification', 'Notification Templates');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="notification-template-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
                'attribute' => 'event',
                'vAlign' => 'middle',
                'width' => '180px',
                'value' => function ($model) {
                    /** @var \core\notification\models\NotificationTemplate $model */
                    return Yii::$app->dataList->notificationEvents[$model->event];
                },
                'filterType' => GridView::FILTER_SELECT2,
                'filter' => Yii::$app->dataList->notificationEvents,
                'filterWidgetOptions' => [
                    'pluginOptions' => ['allowClear' => true],
                ],
                'filterInputOptions' => ['placeholder' => 'Any Type'],
                'format' => 'raw'
            ],
            [
                'attribute' => 'type',
                'vAlign' => 'middle',
                'width' => '180px',
                'value' => function ($model) {
                    /** @var \core\notification\models\NotificationTemplate $model */
                    return Yii::$app->dataList->notificationTypes[$model->type];
                },
                'filterType' => GridView::FILTER_SELECT2,
                'filter' => Yii::$app->dataList->notificationTypes,
                'filterWidgetOptions' => [
                    'pluginOptions' => ['allowClear' => true],
                ],
                'filterInputOptions' => ['placeholder' => 'Any Type'],
                'format' => 'raw'
            ],
            'title',
            'template',
            'receiver',
            'active',

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
