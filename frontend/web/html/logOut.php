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
<div class="container recharge" id="logOut">
    <div class="rechargeContainer rechargeSucceed">
        <h3 class="textCenter fs20">
            <i class="glyphicon glyphicon-ok fs18 mr10 themeColor"></i>您的账户已经成功退出!
        </h3>
        <p class="mt10 textCenter fs18">
            <span id="countTime">5</span>秒后自动跳到首页
        </p>
    </div>
</div>
<?php include "footer.php" ;?>
<script type="text/javascript" src="js/account.js"></script>
</body>
</html>