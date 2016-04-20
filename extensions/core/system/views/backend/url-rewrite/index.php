<?php

use yii\helpers\Html;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel core\system\searches\UrlRewriteSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('core_system', 'Url Rewrites');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="url-rewrite-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'url_rewrite_id:url',
            'request_path',
            'route',
            'params',

            ['class' => 'yii\grid\ActionColumn'],
        ],
        'export' => false,
        'responsive' => true,
        'toolbar' => Html::a(Yii::t('core_system', 'Create Url Rewrite'), ['create'], ['class' => 'btn btn-info']),
        'containerOptions' => ['style' => 'overflow: auto'], // only set when $responsive = false
        'headerRowOptions' => ['class' => 'kartik-sheet-style'],
        'filterRowOptions' => ['class' => 'kartik-sheet-style'],
        'panelHeadingTemplate' => '<h3 class="panel-title"><i class="glyphicon glyphicon-globe"></i> ' . Html::encode($this->title) . '</h3>',
        'panel' => [
            'type' => GridView::TYPE_DEFAULT,
//            'before' => Html::a(Yii::t('core_system', 'Create Url Rewrite'), ['create'], ['class' => 'btn btn-info']),
            'after' => false,
            'footer' => false
        ],
    ]); ?>

</div>
