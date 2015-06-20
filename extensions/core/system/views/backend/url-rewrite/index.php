<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel core\system\searches\UrlRewriteSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('core_system', 'Url Rewrites');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="url-rewrite-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('core_system', 'Create Url Rewrite'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

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
    ]); ?>

</div>
