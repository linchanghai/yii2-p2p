<?php
/**
 * Created by PhpStorm.
 * User: LCH
 * Date: 2015/7/1
 * Time: 10:14
 */

use kiwi\Kiwi;
use yii\helpers\Url;

/* @var $this \yii\web\View */
/** @var \p2p\project\models\Project $project */

$this->params['project-list'] = true;

$this->registerCssFile(Yii::$app->urlManager->baseUrl . '/css/invest.min.css', ['depends' => [\frontend\assets\RequireAsset::className()]]);

$this->registerJsFile(Yii::$app->urlManager->baseUrl . '/js/invest.js', ['depends' => [\frontend\assets\RequireAsset::className()]]);

?>

<div class="container mt20 investTitleTop">
    <div class="fl investTitleLeft">短期理财</div>
    <div class="fr investTitleRight">
        年化收益率高达12%
        <a class="fr" href="#">更多 ></a>
    </div>
</div>
<div class="container investWrap">
    <div class="fl progressWrap">
        <div class="progress">
            <div class="progress-bar progress-bar-striped"
                 style="width: <?= ($project->invested_money / $project->invest_total_money) * 100 ?>%;"></div>
        </div>
        <p class="mt20 fs30 textCenter themeColor">
            <?= ($project->invested_money / $project->invest_total_money) * 100 ?>%
        </p>
    </div>
    <div class="fl progressWrapDetail">
        <p class="mb20">
            <label>产品期号: </label>
            <span class="col333"><?= $project->project_no; ?>期</span>
        </p>

        <p class="mb20">
            <label>项目金额: </label>
            <span class="col333"><?= $project->invest_total_money; ?>元</span>
        </p>

        <p class="mb20">
            <label>剩余金额: </label>
            <span class="col333"><?= $project->invest_total_money - $project->invested_money; ?>元</span>
        </p>

        <p class="mb20">
            <label>收款方式: </label>
            <span class="col333"><?= Kiwi::getDataListModel()->projectRepaymentType[$project->repayment_type]; ?></span>
        </p>

        <p class="mb20">
            <label>还款日期: </label>
            <span class="col333"><?= date('Y-m-d', $project->repayment_date); ?></span>
        </p>
    </div>
    <div class="fl progressWrapDetail progressWrapDetail2">
        <p class="mb20">
            <label>理财期限: </label>
            <span class="col333"><?= ceil(($project->repayment_date - time()) / (3600 * 24)) ?>天</span>
        </p>

        <p class="mb20">
            <label>预期年化收益率: </label>
            <span class="col333"><?= $project->interest_rate; ?>%</span>
        </p>

        <p class="mb20">
            <label>奖励说明: </label>
            <span class="col333">送积分，送会员成长值</span>
        </p>
    </div>
    <div class="fl investArea">

    </div>
</div>