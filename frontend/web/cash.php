<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>Examples</title>
    <meta name="description" content="" />
    <meta name="keywords" content="" />
    <link href="css/style.min.css" rel="stylesheet" />
    <link href="css/account.min.css" rel="stylesheet" />
</head>
<body>
<?php include "header.php" ;?>
<div class="container twoContainer">
    <?php include "accountSide.php" ;?>
    <div class="containerMain recharge">
        <ul class="clearFix rechargeTitle">
            <li><a class="active" href="#">网银支付</a></li>
            <li><a href="#">提现进度</a></li>
        </ul>
        <form class="rechargeContainer">
            <dl class="clearFix payWays">
                <dt class="fl mr16">选择银行卡:</dt>
                <dd class="fl payWayWrap">
                    <ul>
                        <li class="addBank">
                            <i>+</i>
                            <div class="addText">
                                添加一张银行卡
                            </div>
                        </li>
                    </ul>
                </dd>
            </dl>
            <dl class="clearFix mt10 payWays">
                <dt class="fl mr16">填写提现信息:</dt>
                <dd class="fl cashWrap">
                    <ul class="rechargeArea cashArea">
                        <li>
                            <label class="mr16">可提金额:</label>
                            <span>0.00元</span>
                        </li>
                        <li class="mt10">
                            <label class="mr16" for="cash">充值金额:</label>
                            <input type="text" class="formControl mr16" id="cash" maxlength="8" name="cash" />
                            <span class="errorColor hide">充值金额必须为大于10的整数</span>
                        </li>
                        <li class="mt10">
                            <label class="mr16">手续费:</label>
                            <span>0.00元</span>
                        </li>
                        <li class="mt10">
                            <label class="mr16">实际提现金额:</label>
                            <span>0.00元</span>
                        </li>
                        <li class="mt10">
                            <label class="mr16" for="traPwd">交易密码:</label>
                            <input type="text" class="formControl mr16" id="traPwd" maxlength="18" name="traPwd" />
                            <span class="errorColor hide">交易密码错误</span>
                        </li>
                        <li class="mt10">
                            <label class="invisible mr16">提现</label>
                            <button type="submit" class="mt10 btn regularBtn themeBtn" id="rechargeBtn">提现</button>
                        </li>
                    </ul>
                </dd>
            </dl>

            <div class="rechargeHint mt40">
                <p class="col333"><i class="secondColor glyphicon glyphicon-info-sign fs16"></i>温馨提示:</p>
                <p class="mt10">1.单笔提现金额上限20万元;</p>
                <p class="mt10">2.收到您的提现请求后，我们江在1个工作日(双休日或法定节假日顺延)处理你哪的提现申请,请你注意查收;</p>
                <p class="mt10">3.如果在提现过程中遇到问题请致电：<span class="themeColor">400-812-0574</span>,我们的客服竭诚为您服务;</p>
                <p class="mt10">4.如果您填写的提现信息不正确可能回导致提现失败，由此产生的提现费用讲不予返还;</p>
                <p class="mt10">5.每月手臂提现免手续费,之后提现恢复收取2.00元手续费;</p>
                <p class="mt10">6.当您的提现操作出现认为异常时,(包括但不限于涉嫌非法套现等违法行为),我们将视具体情况提高您的审核级别(包括但不限于要求提供证明,演唱审核时间等)我们将最大限度保证您的资金安全;</p>
            </div>
        </form>
    </div>
</div>
<div class="modal paddingModal fade" id="rechargeModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h3 class="modal-title" id="myModalLabel">登录网上银行充值</h3>
            </div>
            <div class="modal-body">
                <h4 class="mb20">请在新打开的网银页面完成充值后选择</h4>
                <dl class="clearFix mt10 rechargeOptions">
                    <dt class="fs20 fl themeColor">
                        <i class="glyphicon glyphicon-ok mr10"></i>充值成功
                    </dt>
                    <dd class="fl ml20">
                        您可以选择: <a href="#" class="ml20 themeColor">查看资产总额</a><a href="#" class="ml10 themeColor">购买理财</a>
                    </dd>
                </dl>
                <dl class="clearFix mt20 rechargeOptions">
                    <dt class="fs20 fl secondColor">
                        <i class="glyphicon glyphicon-info-sign mr10"></i>充值失败
                    </dt>
                    <dd class="fl ml20">
                        您可以选择: <a href="#" class="ml20 themeColor">其他充值方式</a><a href="#" class="ml10 themeColor">查看充值帮助</a>
                    </dd>
                </dl>
            </div>

        </div>
    </div>
</div>
<?php include "footer.php" ;?>
<script type="text/javascript" src="js/account.js"></script>
</body>
</html>