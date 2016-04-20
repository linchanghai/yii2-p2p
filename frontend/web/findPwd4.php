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
        <ul class="clearFix rechargeTitle tabs">
            <li><a href="#">登录密码</a></li>
            <li><a class="active" href="#">交易密码</a></li>
        </ul>
        <form class="backGrey p20 modifyPwdForm">
            <div class="withdrawPsw-step">
                <ol class="ui-step ui-step-4 clearFix">
                    <li class="ui-step-start ui-step-active">
                        <div class="ui-step-line">-</div>
                        <div class="ui-step-icon">
                            <i class="iconfont"></i>
                            <i class="ui-step-number">1</i>
                            <span class="ui-step-text">填写账户信息</span>
                        </div>
                    </li>
                    <li class="ui-step-active">
                        <div class="ui-step-line">-</div>
                        <div class="ui-step-icon">
                            <i class="iconfont"></i>
                            <i class="ui-step-number">2</i>
                            <span class="ui-step-text">验证账户信息</span>
                        </div>
                    </li>
                    <li class="ui-step-active">
                        <div class="ui-step-line">-</div>
                        <div class="ui-step-icon">
                            <i class="iconfont"></i>
                            <i class="ui-step-number">3</i>
                            <span class="ui-step-text">重置密码</span>
                        </div>
                    </li>
                    <li class="ui-step-end ui-step-active">
                        <div class="ui-step-line">-</div>
                        <div class="ui-step-icon">
                            <i class="iconfont"></i>
                            <i class="ui-step-number">3</i>
                            <span class="ui-step-text">完成</span>
                        </div>
                    </li>
                </ol>
            </div>
            <div class="stepForm">
                <h3 class="myWalletOutResultInfo fs18 textCenter">
                    <i class="glyphicon glyphicon-ok-sign secondColor mr10 fs20"></i>恭喜您，成功找回密码!您需要重新信登录系统
                </h3>
                <div class="mt20 textCenter">
                    <span id="loginNow">10</span>秒后将自动跳转到登录页面
                </div>
                <div class="mt20 textCenter">
                    <a href="/" id="loginAddress" class="btn secondBtn regularBtn">立即登录</a>
                </div>
            </div>
        </form>
    </div>
</div>
<?php include "footer.php" ;?>
<script type="text/javascript" src="js/account.js"></script>
</body>
</html>