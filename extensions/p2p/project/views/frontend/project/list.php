<?php
/**
 * Created by PhpStorm.
 * User: LCH
 * Date: 2015/6/29
 * Time: 9:22
 */

use yii\helpers\Url;

/* @var $this \yii\web\View */
$this->params['project-list'] = true;

$this->registerCssFile(Yii::$app->urlManager->baseUrl . '/css/invest.min.css', ['depends' => [\frontend\assets\RequireAsset::className()]]);

$this->registerJsFile(Yii::$app->urlManager->baseUrl . '/js/invest.js', ['depends' => [\frontend\assets\RequireAsset::className()]]);
?>

<div class="investTitle backGrey">
    <ul class="container">
        <li class="active">
            <a href="#">项目列表</a>
        </li>
        <li>
            <a href="#">项目转让列表</a>
        </li>
    </ul>
</div>
<div class="investFilter">
    <div class="container">
        <div class="clearFix mt10 filterLine">
            <label>项目期限:</label>
            <a class="active" href="#">全部</a>
            <a href="#">一个月以内</a>
            <a href="#">1-3个月</a>
            <a href="#">3-6个月</a>
            <a href="#">6个月以上</a>
        </div>
        <div class="clearFix mt10 filterLine">
            <label>项目收益:</label>
            <a class="active" href="#">全部</a>
            <a href="#">9%以下</a>
            <a href="#">9%-13%</a>
            <a href="#">13%以上</a>
        </div>
    </div>
</div>
<div class="mt20 investList">
    <ul class="container">
        <?php
        /** @var \p2p\project\models\Project $project */
        foreach ($projects as $project) { ?>
            <li>
                <div class="proTitle col333 textCenter fs16">
                    <?= $project->project_name; ?>
                </div>
                <div class="progress mt20">
                    <div class="progress-bar progress-bar-striped"
                         style="width: <?= ($project->invested_money / $project->invest_total_money) * 100 ?>%;"></div>
                </div>
                <p class="col666">
                    <?= $project->invested_money; ?> /<span class="col999"><?= $project->invest_total_money; ?></span>
                </p>

                <p class="fs12 mt10 investListBrief">
                    <?= $project->projectDetails->project_introduce; ?>
                </p>

                <div class="clearFix mt20">
                    <div class="fl investListDetail">
                        <p class="textCenter themeColor"><?= $project->interest_rate; ?>%</p>

                        <p class="textCenter mt10">年利率</p>
                    </div>
                    <div class="fr investListDetail">
                        <p class="textCenter">
                            <?= ceil(($project->repayment_date - time()) / (3600 * 24)) ?>天
                        </p>

                        <p class="textCenter mt10">期限</p>
                    </div>
                </div>
                <a class="checkItem"
                   href="<?= Url::to(['/project/project/details', 'project_id' => $project->project_id]) ?>">
                    查看详情
                </a>
                <a class="checkItem" href="<?= Url::to(['/']) ?>">
                    立即投资
                </a>
            </li>
        <?php } ?>
    </ul>
</div>