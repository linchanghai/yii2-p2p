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
    <div class="containerMain">
        <ul class="clearFix rechargeTitle">
            <li><a class="active" href="#">转出</a></li>
            <li><a href="#">转入</a></li>
        </ul>
        <div class="backGrey myWalletArea">
            <div class="itemTitle">
                转出到余额 <span class="warningColor ml20">免手续费</span>
            </div>
            <div class="clearFix fs16 myWalletOutResult">
                <div class="myWalletOutResultInfo fs18 textCenter">
                    <i class="glyphicon glyphicon-ok-sign secondColor mr10 fs20"></i>转出钻点钱包成功!
                </div>
                <div class="myWalletOutResultDown mt20 textCenter">
                    转出金额: 1000元
                </div>
                <div class="myWalletOutResultArea mt20 textCenter">
                    <p>最快0秒，最晚1-2工作日到达您钻点账户</p>
                    <p class="mt20">详情查看: <a href="#" class="secondColor">钻点钱包明细</a></p>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include "footer.php" ;?>
<script type="text/javascript" src="js/account.js"></script>
</body>
</html>