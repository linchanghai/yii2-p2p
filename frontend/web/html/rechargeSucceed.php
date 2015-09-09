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
        <div class="rechargeContainer rechargeSucceed">
            <h3>
                <i class="glyphicon glyphicon-ok fs18 mr10 themeColor"></i>您的账户已成功充值1000元!
            </h3>
            <dl class="clearFix mt10 rechargeOptions">
                <dd class="fl ml20">
                    您可以选择: <a href="#" class="ml20 themeColor">查看资产总额</a><a href="#" class="ml10 themeColor">购买理财</a>
                </dd>
            </dl>
        </div>
    </div>
</div>
<?php include "footer.php" ;?>
<script type="text/javascript" src="js/account.js"></script>
</body>
</html>