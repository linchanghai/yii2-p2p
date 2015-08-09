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
    <div class="fl investTitleLeft">红包兑换</div>
    <div class="fr investTitleRight integralTopRight">
        <a class="fr" href="#">更多 ></a>
    </div>
</div>
<div class="container mt20 couponExchange">
    <div class="fl backGrey showExample">
        <h2 class="textCenter themeColor">钻点红包</h2>
        <div class="mt40 integralItemDetail">
            1元
        </div>
    </div>
    <form class="fr backGrey exchangeArea">
        <h2 class="themeColor">钻点投资红包</h2>
        <div class="mt10"><label class="col666">有效期限: </label>永久</div>
        <div class="mt10"><label class="col666">礼品类型: </label>电子票券</div>
        <div class="mt40"><label class="col666">换购积分: </label><span id="leastLine">30</span></div>
        <div class="mt10 clearFix integralArea">
            <label class="fl">换购数量:</label>
            <div class="fl ml10 moneyArea">
                <span class="fl operate minus">-</span>
                <input type="text" name="" value="1" maxlength="9999" class="fl investMoney" />
                <span class="fl operate plus">+</span>
            </div>
        </div>
        <div class="clearFix mt20 myIntegralItem">
            <button type="submit" class="fl btn regularBtn mr16">换购</button>
            <div class="fl ml10 myIntegralArea">
                我的积分: <span id="myIntegral" class="themeColor">200</span>
            </div>
        </div>
        <div class="mt10">
            <a class="fs12 themeColor" href="#">如何使用?</a>
        </div>
    </form>
</div>
<div class="container mt20 backGrey investRule">
    <ul class="clearFix investRuleTap">
        <li class="active">礼品详情</li>
    </ul>
    <div class="investRuleDetail">
        <div class="investSingleRule">
            <table class="table tableNoBorder investSingleRule1">
                <tbody>
                <tr>
                    <td class="textRight">礼品名称</td>
                    <td>钻点1元红包</td>
                </tr>
                <tr>
                    <td class="textRight">有效期限</td>
                    <td>永久</td>
                </tr>
                <tr>
                    <td class="textRight">使用方法</td>
                    <td class="secondColor">换购成功后在“我的账户——我的奖励”中查看</td>
                </tr>
                <tr>
                    <td class="textRight">换购条件</td>
                    <td class="secondColor">所有投资用户可换购</td>
                </tr>
                </tbody>
            </table>
        </div>

    </div>
</div>
<?php include "footer.php";?>
<script type="text/javascript" src="js/integral.js"></script>
</body>
</html>