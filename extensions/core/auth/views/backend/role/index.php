<?php

use yii\helpers\Html;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('core_auth', 'Role List');
$this->params['breadcrumbs'][] = $this->title;
$this->params['topMenuKey'] = 'system';
$this->params['leftMenuKey'] = 'role';
?>
<div class="role-index">

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            ['label' => Yii::t('core_auth', 'Role Name'), 'attribute' => 'description'],

            ['class' => 'yii\grid\ActionColumn', 'template' => '{update} {delete}'],
        ],
        'export' => false,
        'responsive' => true,
        'toolbar' => Html::a(Yii::t('core_auth', 'Create {modelClass}', [
            'modelClass' => Yii::t('core_auth', 'Role'),
        ]), ['create'], ['class' => 'btn btn-info']),
        'containerOptions' => ['style' => 'overflow: auto'], // only set when $responsive = false
        'headerRowOptions' => ['class' => 'kartik-sheet-style'],
        'filterRowOptions' => ['class' => 'kartik-sheet-style'],
        'panelHeadingTemplate' => '<h3 class="panel-title"><i class="glyphicon glyphicon-globe"></i> ' . Html::encode($this->title) . '</h3>',
        'panel' => [
            'type' => GridView::TYPE_DEFAULT,
//            'before' => Html::a(Yii::t('core_auth', 'Create {modelClass}', [
//                    'modelClass' => Yii::t('core_auth', 'Role'),
//            ]), ['create'], ['class' => 'btn btn-info']),
            'after' => false,
            'footer' => false
        ],
    ]); ?>

</div>
