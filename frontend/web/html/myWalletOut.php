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
            <div class="clearFix p20 fs16 myWalletOut">
                <div class="clearFix">
                    <div class="fl myWalletOutLeft">
                        <label>可转钻点钱包额度:</label> <span id="myWalletOver">1000.60</span>元
                    </div>
                    <div class="fl ml20">
                        总收益: 0.6元
                    </div>
                </div>
                <form class="mt20" id="walletSubmit">
                    <div class="clearFix">
                        <div class="fl myWalletOutLeft">
                            <label for="">转出本金: </label><input class="ml10 formControl" type="text" id="myWalletNumber" />
                        </div>
                        <div class="fl ml20 warningColor">
                            每人每天只有一次转出机会
                        </div>
                    </div>
                    <div class="mt20">
                        <div class="ml10 myWalletOutLeft errorColor hide">
                            <label></label>
                            转出金额不正确
                        </div>
                        <div class="mt10 myWalletOutLeft">
                            <label></label>
                            <button type="submit" class="btn regularBtn">确认转出</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php include "footer.php" ;?>
<script type="text/javascript" src="js/account.js"></script>
</body>
</html>