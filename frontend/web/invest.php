<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>Examples</title>
    <meta name="description" content="" />
    <meta name="keywords" content="" />
    <link href="css/style.min.css" rel="stylesheet" />
    <link href="css/invest.min.css" rel="stylesheet" />
</head>
<body>
<?php include "header.php" ;?>
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
            <div class="progress-bar progress-bar-striped" style="width: 10%;"></div>
        </div>
        <p class="mt20 fs30 textCenter themeColor">10%</p>
    </div>
    <div class="fl progressWrapDetail">
        <p class="mb20">
            <label>产品期号: </label><span class="col333">Z00000089期</span>
        </p>
        <p class="mb20">
            <label>项目金额: </label><span class="col333">2000000元</span>
        </p>
        <p class="mb20">
            <label>剩余金额: </label><span class="col333">1800000元</span>
        </p>
        <p class="mb20">
            <label>收款方式: </label><span class="col333">按月付息，到期还本</span>
        </p>
        <p class="mb20">
            <label>还款日期: </label><span class="col333">2015-09-25</span>
        </p>
    </div>
    <div class="fl progressWrapDetail progressWrapDetail2">
        <p class="mb20">
            <label>理财期限: </label><span class="col333">30天</span>
        </p>
        <p class="mb20">
            <label>预期年化收益率: </label><span class="col333">8%</span>
        </p>
        <p class="mb20">
            <label>奖励说明: </label><span class="col333">送积分，送会员成长值</span>
        </p>
    </div>
    <div class="fr investArea">
        <p class="mt10">
            可投金额: <span class="fs16" id="mostMoney">300000</span> 元
        </p>
        <p class="mt20">
            起息方式: T(成交日)+1
        </p>
        <p class="mt20"><span class="themeColor" id="leastMoney">1000</span> 元起投</p>
        <p class="toInvestArea">
            <span class="btn secondBtn toInvest">立即投资</span><span class="btn toInvest themeBtn toCalc">计算</span>
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
                        <td>2015-07-07</td>
                    </tr>
                    <tr>
                        <td class="textRight">预期年化收益率</td>
                        <td class="secondColor">12%</td>
                    </tr>
                    <tr>
                        <td class="textRight">加入条件</td>
                        <td class="secondColor">	1,000元起，以1,000元的倍数递增</td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="investSingleRule hide">2</div>
        <div class="investSingleRule hide">3</div>
        <div class="investSingleRule hide">4</div>
    </div>
</div>
<div class="modal fade" id="investModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">填写投资金额</h4>
            </div>
            <div class="modal-body">
                <form class="clearFix prepInvest" method="post" action="">
                    <div class="fl investModalArea">
                        <div class="clearFix">
                            <label class="fl">投资金额:</label>
                            <div class="fl ml10 moneyArea">
                                <span class="fl operate minus">-</span>
                                <input type="text" name="" value="1000" class="fl investMoney" />
                                <span class="fl operate plus">+</span>
                            </div>
                        </div>
                        <p class="mt20">账户余额: <span id="myMoney">1000</span>元 </p>
                    </div>
                    <div class="fr">
                        <button class="btn largeBtn secondBtn investNow" type="submit">确认投资</button>
                    </div>
                </form>
                <div class="mt20 investSingleMoney">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>年化收益率</th>
                                <th>可获得收益: 200元</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>付息时间: 2015-07-07</td>
                                <td>支付利息: 20元</td>
                            </tr>
                            <tr>
                                <td>付息时间: 2015-08-07</td>
                                <td>支付利息: 20元</td>
                            </tr>
                            <tr>
                                <td>付息时间: 2015-09-07</td>
                                <td>支付利息: 20元</td>
                            </tr>
                            <tr>
                                <td>付息时间: 2015-09-07</td>
                                <td>支付利息: 20元</td>
                            </tr>
                            <tr>
                                <td>付息时间: 2015-09-07</td>
                                <td>支付利息: 20元</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer clearFix">
                <a class="fr btn regularBtn secondBtn" href="#">充值</a>
                <span class="fr themeColor mt10 mr16"><i class="glyphicon glyphicon-exclamation-sign"></i>充值余额不足，充值后可购买</span>
            </div>s
        </div>
    </div>
</div>
<?php include "footer.php" ;?>
<script type="text/javascript" src="js/invest.js"></script>
</body>
</html>