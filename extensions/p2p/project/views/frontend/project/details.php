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
    <div class="fr investArea">
        <p class="mt10">
            可投金额: <span class="fs16"
                        id="mostMoney"><?= $project->invest_total_money - $project->invested_money; ?></span> 元
        </p>

        <p class="mt20">
            起息方式: T(成交日)+1
        </p>

        <p class="mt20"><span class="themeColor" id="leastMoney"><?= $project->min_money; ?></span> 元起投</p>

        <p class="toInvestArea" data-url="<?= Url::to(['/project/project-invest/interest-table','project_id' => $project->project_id]) ?>">
            <span class="btn themeBtn toInvest">立即投资</span><span class="btn toInvest toCalc">计算</span>
        </p>
    </div>
</div>
<div class="container mt20 backGrey investRule">
    <ul class="clearFix investRuleTap">
        <li class="active">项目详情</li>
        <li>项目图片资料</li>
        <li>法律意见书</li>
        <li>投资记录</li>
    </ul>
    <div class="investRuleDetail">
        <div class="investSingleRule">
            <table class="table tableNoBorder investSingleRule1">
                <tbody>
                <tr>
                    <td class="textRight">保障方式</td>
                    <td>100%本息保障计划</td>
                </tr>
                <tr>
                    <td class="textRight">可加入日期</td>
                    <td><?= date('Y-m-d', $project->repayment_date); ?></td>
                </tr>
                <tr>
                    <td class="textRight">预期年化收益率</td>
                    <td class="secondColor"><?= $project->interest_rate; ?>%</td>
                </tr>
                <tr>
                    <td class="textRight">加入条件</td>
                    <td class="secondColor">    <?= $project->min_money; ?>元起，以<?= $project->min_money; ?>元的倍数递增</td>
                </tr>
                </tbody>
            </table>
        </div>
        <div class="investSingleRule hide"><?= $project->projectMaterial->material; ?></div>
        <div class="investSingleRule hide"><?= $project->projectLegalOpinion->legal_info; ?></div>
        <div class="investSingleRule hide"></div>
    </div>
</div>
<div class="modal fade" id="investModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">填写投资金额</h4>
            </div>
            <div class="modal-body">
                <form class="clearFix prepInvest" method="post" action="">
                    <div class="fl investModalArea">
                        <div class="clearFix">
                            <label class="fl">投资金额:</label>

                            <div class="fl ml10 moneyArea">
                                <span class="fl operate minus">-</span>
                                <input type="text" name="" value="<?= $project->min_money; ?>" class="fl investMoney"/>
                                <span class="fl operate plus">+</span>
                            </div>
                        </div>
                        <p class="mt20">账户余额: <span id="myMoney">1000</span>元 </p>
                    </div>
                    <div class="fr">
                        <button class="btn largeBtn investNow" type="submit">确认投资</button>
                    </div>
                </form>
                <div class="mt20 investSingleMoney">

                </div>
            </div>
            <div class="modal-footer">
                <a class="btn regularBtn themeBtn" href="#">充值</a>
            </div>
        </div>
    </div>
</div>