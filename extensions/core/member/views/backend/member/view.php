<?php

use yii\bootstrap\Tabs;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model core\member\models\Member */

$this->title = $model->member_id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('core_member', 'Members'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="member-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('core_member', 'Update'), ['update', 'id' => $model->member_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('core_member', 'Delete'), ['delete', 'id' => $model->member_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('core_member', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?php
    $memberContent = DetailView::widget([
        'model' => $model,
        'attributes' => [
            'member_id',
            'username',
            'mobile',
            'email:email',
            'real_name',
            'id_card',
            'recommend_user',
            'recommend_type',
            'status',
            'create_time:datetime',
            'update_time:datetime',
        ],
    ]);
    Tabs::widget(['items' => [

    ]]); ?>
</div>
