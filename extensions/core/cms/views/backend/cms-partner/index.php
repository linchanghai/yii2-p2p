<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use kiwi\Kiwi;
/* @var $this yii\web\View */
/* @var $searchModel core\cms\searches\CmsPartnerSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('core_cms', 'Cms Partners');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cms-partner-index">

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'img_icon',
            'title',
            'content:ntext',
            'create_time:datetime',
             'update_time:datetime',
            [
                'attribute'=>'create_by',
                'vAlign'=>'middle',
                'width'=>'180px',
                'value'=>function ($model, $key, $index, $widget) {
                    $member = \kiwi\Kiwi::getMember()->findOne($model->create_by);
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
                'attribute'=>'update_by',
                'vAlign'=>'middle',
                'width'=>'180px',
                'value'=>function ($model, $key, $index, $widget) {
                    $member = \kiwi\Kiwi::getMember()->findOne($model->update_by);
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
            // 'is_delete',

            ['class' => 'yii\grid\ActionColumn'],
        ],
        'export' => false,
        'responsive' => true,
        'toolbar' => Html::a(Yii::t('core_cms', 'Create'), ['create'], ['class' => 'btn btn-info']),
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
