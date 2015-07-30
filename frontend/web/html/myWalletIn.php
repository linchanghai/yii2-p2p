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
            <li><a href="#">转出</a></li>
            <li><a class="active" href="#">转入</a></li>
        </ul>
        <div class="backGrey myWalletArea">
            <div class="itemTitle">
                转入到钻点钱包
            </div>
            <ul class="p20 clearFix myWalletIn">
               <li>
                    <h3 class="mt20">钻点钱包资金</h3>
                    <div class="mt20">52.30元</div>
               </li>
                <li>
                    <h3 class="mt20">累计总收益</h3>
                    <div class="mt20">0.3元</div>
                </li>
                <li class="lastNoBorder textCenter">
                    <h3 class="mt20">账户余额: <span id="myMoney">1000</span>元</h3>
                    <a href="#" class="mt20 btn regularBtn">充值</a>
                </li>
            </ul>
        </div>
        <form class="p20 backGrey myWalletNow" id="walletInForm" action="">
            <div class="clearFix">
                <div class="fl myWalletOutLeft">
                    <label for="">钻点钱包年华收益率: </label>
                    <span class="themeColor">7%</span>
                </div>
            </div>
            <div class="clearFix mt20">
                <div class="fl myWalletOutLeft">
                    <label for="">转入本金: </label><input placeholder="金额为大于1的整数" class="ml10 formControl" type="text" id="myWalletNumber">
                </div>
                <div class="fl ml20">
                    一年收益额约: <span id="willBe"></span>元
                </div>
            </div>
            <div class="clearFix mt20">
                <div class="fl myWalletOutLeft">
                    <label></label>
                        <input type="checkbox" class="prt2" checked disabled />
                        同意 <a class="secondColor" href="#"><<钻点钱包服务协议>></a>
                </div>
            </div>
            <div class="clearFix mt20 errorColor hide">
                <div class="fl myWalletOutLeft">
                    <label></label>
                    <span>转入金额不正确</span>
                </div>
            </div>
            <div class="clearFix mt20">
                <div class="fl myWalletOutLeft">
                    <label></label>
                    <button type="submit" class="btn regularBtn">确认转入</button>
                </div>
            </div>
        </form>
    </div>
</div>
<?php include "footer.php" ;?>
<script type="text/javascript" src="js/account.js"></script>
</body>
</html>