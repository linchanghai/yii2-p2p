<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel core\cms\searches\CmsNoticeSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('core_cms', 'Cms Notices');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cms-notice-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('core_cms', 'Create Cms Notice'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'cms_notice_id',
            'type',
            'img',
            'title',
            'content:ntext',
            // 'create_time:datetime',
            // 'update_time:datetime',
            // 'publihser_date',
            // 'create_by',
            // 'update_by',
            // 'is_delete',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
