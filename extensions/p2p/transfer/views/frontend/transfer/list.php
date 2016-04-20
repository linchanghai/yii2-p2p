<?php
/**
 * Created by PhpStorm.
 * User: LCH
 * Date: 2015/6/29
 * Time: 9:22
 */

use yii\helpers\Url;
use yii\widgets\LinkPager;
use yii\widgets\Pjax;
use frontend\assets\AppAsset;

/* @var $this \yii\web\View */
$this->params['project-list'] = true;

$this->registerCssFile(Yii::$app->urlManager->baseUrl . '/css/invest.min.css', ['depends' => [AppAsset::className()]]);

$this->registerJsFile(Yii::$app->urlManager->baseUrl . '/js/invest.js', ['depends' => [AppAsset::className()]]);
?>

    <div class="investTitle backGrey">
        <ul class="container">
            <li>
                <a href="<?= Url::to(['/project/project/list']) ?>">项目列表</a>
            </li>
            <li class="active">
                <a href="#">项目转让列表</a>
            </li>
        </ul>
    </div>
<?php Pjax::begin(); ?>
    <div class="mt20 investList">
        <ul class="container">
            <?php
            if (isset($models) && $models) {
                /** @var \p2p\transfer\models\ProjectInvestTransferApply $model */
                foreach ($models as $model) {
                    $investedRatio = ($model->project->invested_money / $model->project->invest_total_money) * 100;
                    ?>
                    <li>
                        <div class="proTitle col333 textCenter fs16">
                            <?= $model->project->project_name; ?>
                        </div>
                        <div class="progress mt20">
                            <div class="progress-bar progress-bar-striped <?php if ($investedRatio == 100) {
                                echo 'parogress-succeed';
                            } ?>"
                                 style="width: <?= $investedRatio; ?>%;"></div>
                        </div>
                        <p class="col666">
                            <?= $model->project->invested_money; ?> /<span
                                class="col999"><?= $model->project->invest_total_money; ?></span>
                        </p>

                        <p class="fs12 mt10 investListBrief">
                            <?= $model->project->projectDetails->project_introduce; ?>
                        </p>

                        <div class="clearFix mt20">
                            <div class="fl investListDetail">
                                <p class="textCenter themeColor"><?= $model->project->interest_rate; ?>%</p>

                                <p class="textCenter mt10">年利率</p>
                            </div>
                            <div class="fr investListDetail">
                                <p class="textCenter">
                                    <?= ceil(($model->project->repayment_date - time()) / (3600 * 24)) ?>天
                                </p>

                                <p class="textCenter mt10">期限</p>
                            </div>
                        </div>
                        <a class="checkItem"
                           href="<?= Url::to(['/project/project/details', 'id' => $model->project->project_id]) ?>">
                            查看详情
                        </a>
                    </li>
                <?php }
            } else { ?>
                <li style="width: 100%">
                    <div class="tableNoInfo">
                        <i class="glyphicon glyphicon-info-sign secondColor"></i> 暂无数据
                    </div>
                </li>
            <?php } ?>

        </ul>
    </div>

<?= LinkPager::widget(['pagination' => $pagination]); //todo    ?>
<?php Pjax::end(); ?>