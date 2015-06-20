<?php

use kiwi\Kiwi;
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('core_auth', 'Administrator List');
$this->params['breadcrumbs'][] = $this->title;
$this->params['topMenuKey'] = 'system';
$this->params['leftMenuKey'] = 'user';
?>
<div class="user-index">

    <h2><?= Html::encode($this->title) ?></h2>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('core_auth', 'Create {modelClass}', [
            'modelClass' => Yii::t('core_auth', 'Administrator')
        ]), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            ['label' =>  Yii::t('core_auth', '管理员名称'), 'attribute' => 'username'],
            ['label' =>  Yii::t('core_auth', '邮箱'), 'attribute' => 'email'],
            ['label' =>  Yii::t('core_auth', '状态'), 'attribute' => 'status', 'value' => function($model) {
                $activeList = Kiwi::getDataListModel()->isUserActive;
                return $activeList[$model->status];
            }],
//            'email:email',
            ['class' => 'yii\grid\ActionColumn', 'template' => '{update} {delete}'],
        ],
    ]); ?>

</div>
