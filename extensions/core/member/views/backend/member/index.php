<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel core\member\searches\MemberSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('core_member', 'Members');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="member-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('core_member', 'Create Member'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'member_id',
            'mobile',
            'email:email',
            'real_name',
            'recommend_user',
            'memberStatistic.account_money',
            'memberStatistic.package_money',
            'memberStatus.email_status',
            'memberStatus.mobile_status',
            'memberStatus.id_card_status',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
