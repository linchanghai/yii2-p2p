<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use kiwi\helpers\ArrayHelper;
use kiwi\Kiwi;

/* @var $this yii\web\View */
/* @var $searchModel p2p\withdraw\searches\WithdrawRecordSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('p2p_withdraw', 'Withdraw Records');
$this->params['breadcrumbs'][] = $this->title;

$withdrawClass = Kiwi::getWithdrawRecordClass();
if(isset($status) && $status) {
    if ($status == $withdrawClass::STATUS_PENDING || $status == $withdrawClass::STATUS_FIRST_VERIFY_SUCCESS) {
        $buttonTemplate = '<div style="width: 30px">{update} {delete}</div>';
    } else {
        $buttonTemplate = '<div style="width: 15px">{update}</div>';
    }
}
?>
<div class="withdraw-record-index">


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

//            'deposit_record_id',
            [
                'attribute' => 'member_id',
                'vAlign' => 'middle',
                'width' => '180px',
                'value' => function ($model, $key, $index, $widget) {
                    $member = Kiwi::getMember()->findOne($model->member_id);
                    return $member->username;
                },
                'filterType' => GridView::FILTER_SELECT2,
                'filter' => ArrayHelper::map(Kiwi::getMember()->find()->orderBy('username')->asArray()->all(), 'member_id', 'username'),
                'filterWidgetOptions' => [
                    'pluginOptions' => ['allowClear' => true],
                ],
                'filterInputOptions' => ['placeholder' => 'Any author'],
                'format' => 'raw'
            ],
            'money',
            'counter_fee',
//            'deposit_type',
//             'first_verify_user',
//             'first_verify_date',
//             'second_verify_user',
//             'second_verify_date',
//            'status',
            'create_time:datetime',
            'update_time:datetime',
            // 'is_delete',

            [
                'class' => 'yii\grid\ActionColumn',
                'template' => isset($buttonTemplate) ?: '<div style="width: 30px">{update} {delete}</div>'
            ],
        ],
        'export' => false,
        'responsive' => true,
        'containerOptions' => ['style' => 'overflow: auto'], // only set when $responsive = false
        'headerRowOptions' => ['class' => 'kartik-sheet-style'],
        'filterRowOptions' => ['class' => 'kartik-sheet-style'],
        'panelHeadingTemplate' => '<h3 class="panel-title"><i class="glyphicon glyphicon-globe"></i> ' . Html::encode($this->title) . '</h3>',
        'panel' => [
            'type' => GridView::TYPE_DEFAULT,
//            'before' => Html::a(Yii::t('p2p_project', 'Create Project'), ['create'], ['class' => 'btn btn-info']),
            'before' => false,
            'after' => false,
            'footer' => false
        ],

    ]); ?>

</div>
