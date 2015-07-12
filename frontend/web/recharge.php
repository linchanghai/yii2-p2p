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
        </ul>
        <form class="rechargeContainer">
            <dl class="clearFix payWays">
                <dt class="fl mr16">资金渠道:</dt>
                <dd class="fl payWayWrap">
                    <label class="singleWay" for="pay1">
                        <input class="fl" checked type="radio" id="pay1" name="payway">
                        <img class="fl active" src="https://images.iqianjin.com/images/banks/lwrite/wangyin.png?v=201507091931" width="136" height="36" alt="" />
                    </label>
                    <label class="singleWay" for="pay2">
                        <input class="fl" type="radio" id="pay2" name="payway">
                        <img class="fl" src="https://images.iqianjin.com/images/banks/lwrite/wangyin.png?v=201507091931" width="136" height="36" alt="" />
                    </label>
                </dd>
            </dl>
            <dl class="clearFix mt10 payWays">
                <dt class="fl mr16">充值银行:</dt>
                <dd class="fl payWayWrap">
                    <label class="singleWay" for="pay3">
                        <input class="fl" type="radio" id="pay3" name="payway">
                        <img class="fl" src="https://images.iqianjin.com/images/banks/lwrite/wangyin.png?v=201507091931" width="136" height="36" alt="" />
                    </label>
                    <label class="singleWay" for="pay4">
                        <input class="fl" type="radio" id="pay4" name="payway">
                        <img class="fl" src="https://images.iqianjin.com/images/banks/lwrite/wangyin.png?v=201507091931" width="136" height="36" alt="" />
                    </label>
                    <label class="singleWay" for="pay5">
                        <input class="fl" type="radio" id="pay3" name="payway">
                        <img class="fl" src="https://images.iqianjin.com/images/banks/lwrite/wangyin.png?v=201507091931" width="136" height="36" alt="" />
                    </label>
                    <label class="singleWay" for="pay6">
                        <input class="fl" type="radio" id="pay4" name="payway">
                        <img class="fl" src="https://images.iqianjin.com/images/banks/lwrite/wangyin.png?v=201507091931" width="136" height="36" alt="" />
                    </label>
                </dd>
            </dl>
            <dl class="clearFix payWays" id="payHide">
                <dt class="fl mr16 invisible">充值银行:</dt>
                <dd class="fl payWayWrap">
                    <label class="singleWay" for="pay7">
                        <input class="fl" type="radio" id="pay7" name="payway">
                        <img class="fl" src="https://images.iqianjin.com/images/banks/lwrite/wangyin.png?v=201507091931" width="136" height="36" alt="" />
                    </label>
                    <label class="singleWay" for="pay8">
                        <input class="fl" type="radio" id="pay8" name="payway">
                        <img class="fl" src="https://images.iqianjin.com/images/banks/lwrite/wangyin.png?v=201507091931" width="136" height="36" alt="" />
                    </label>
                    <label class="singleWay" for="pay9">
                        <input class="fl" type="radio" id="pay9" name="payway">
                        <img class="fl" src="https://images.iqianjin.com/images/banks/lwrite/wangyin.png?v=201507091931" width="136" height="36" alt="" />
                    </label>
                    <label class="singleWay" for="pay10">
                        <input class="fl" type="radio" id="pay10" name="payway">
                        <img class="fl" src="https://images.iqianjin.com/images/banks/lwrite/wangyin.png?v=201507091931" width="136" height="36" alt="" />
                    </label>
                    <label class="singleWay" for="pay11">
                        <input class="fl" type="radio" id="pay11" name="payway">
                        <img class="fl" src="https://images.iqianjin.com/images/banks/lwrite/wangyin.png?v=201507091931" width="136" height="36" alt="" />
                    </label>
                    <label class="singleWay" for="pay12">
                        <input class="fl" type="radio" id="pay12" name="payway">
                        <img class="fl" src="https://images.iqianjin.com/images/banks/lwrite/wangyin.png?v=201507091931" width="136" height="36" alt="" />
                    </label>
                </dd>
            </dl>
            <div class="toggleItem" id="toggleItem">展开更多银行</div>
            <ul class="mt10 rechargeArea">
                <li class="mt10">
                    <label class="mr16">可投金额:</label>
                    <span>0.00元</span>
                </li>
                <li class="mt10">
                    <label class="mr16" for="chargeMoney">充值金额:</label>
                    <input type="text" class="formControl mr16" id="chargeMoney" maxlength="8" name="chargeMoney" />
                    <span class="errorColor hide">充值金额必须为大于10的整数</span>
                </li>
                <li class="mt10">
                    <label class="invisible mr16">充值</label>
                    <button type="submit" class="mt10 btn regularBtn themeBtn" id="rechargeBtn">充值</button>
                </li>
            </ul>
            <div class="rechargeHint mt40">
                <p class="col333"><i class="secondColor glyphicon glyphicon-info-sign fs16"></i>温馨提示:</p>
                <p class="mt10">1.充值不收任何手续费;</p>
                <p class="mt10">2.单次充值金额需大于或等于10元;</p>
                <p class="mt10">3.如果在充值过程中遇到问题请致电：<span class="themeColor">400-812-0574</span>，我们的客服竭诚为您服务;</p>
                <p class="mt10">4.银行卡余额不足需要先补充金额后再次充值;</p>
                <p class="mt10">5.开通网银方法:（1）携带本人身份证到银行柜台办理。（2）登录网上银行办理;</p>
                <p class="mt10">6.如果存在银行卡状态异常情况，请联系银行做取消挂失或补卡处理;</p>
                <p class="mt10">7.每日的充值限额依据各银行限额为准，请注意您的银行卡充值限制，以免造成不便;</p>
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