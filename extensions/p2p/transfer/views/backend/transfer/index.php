<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use kiwi\Kiwi;

/* @var $this yii\web\View */
/* @var $searchModel p2p\transfer\searches\ProjectInvestTransferApplySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('p2p_transfer', 'Project Invest Transfer Applies');
$this->params['breadcrumbs'][] = $this->title;

$transferClass = Kiwi::getProjectInvestTransferApplyClass();
$createButton = $status == $transferClass::STATUS_PENDING ? true : false;
if($createButton) {
    $buttonTemplate = '<div style="width: 30px">{update} {delete}</div>';
} else {
    $buttonTemplate = '<div style="width: 15px">{update}</div>';
}
?>
<div class="project-invest-transfer-apply-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

//            'project_invest_transfer_apply_id',
//            'project_invest_id',
            'project.project_name',
            'member.username',
            'min_money',
             'total_invest_money',
             'discount_rate',
            // 'status',
            // 'verify_user',
            // 'verify_date',
             'counter_fee',
            // 'create_time:datetime',
            // 'update_time:datetime',
            // 'is_delete',

            [
                'class' => 'yii\grid\ActionColumn',
                'template' => $buttonTemplate
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
            'before' => false,
            'after' => false,
            'footer' => false
        ],
    ]); ?>

</div>
