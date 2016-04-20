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
                <ol class="ui-step ui-step-3 clearFix">
                    <li class="ui-step-start ui-step-active">
                        <div class="ui-step-line">-</div>
                        <div class="ui-step-icon">
                            <i class="iconfont"></i>
                            <i class="ui-step-number">1</i>
                            <span class="ui-step-text">获取验证码</span>
                        </div>
                    </li>
                    <li class="ui-step-active">
                        <div class="ui-step-line">-</div>
                        <div class="ui-step-icon">
                            <i class="iconfont"></i>
                            <i class="ui-step-number">2</i>
                            <span class="ui-step-text">设置交易密码</span>
                        </div>
                    </li>
                    <li class="ui-step-end">
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
                <div class="formGroup mt20 clearFix">
                    <label class="fl modLabel" for="oldPwd">交易密码</label>
                    <input class="fl modInput" type="password" id="oldPwd" placeholder="请输入旧密码" />
                    <div class="fl loginError errorColor ml20">
                        <i class="glyphicon glyphicon-exclamation-sign"></i>密码错误
                    </div>
                </div>
                <div class="formGroup mt20 clearFix">
                    <label class="fl modLabel" for="password">请输入新提现密码</label>
                    <input class="fl modInput" type="password" id="password" placeholder="请输入新提现密码" />
                    <div class="fl loginError errorColor ml20">
                        <i class="glyphicon glyphicon-exclamation-sign"></i>两次密码不一致
                    </div>
                </div>
                <div class="formGroup mt20 clearFix">
                    <label class="fl modLabel" for="confirmPwd">请确认新提现密码</label>
                    <input class="fl modInput" type="password" id="confirmPwd" placeholder="请确认新提现密码" />
                </div>
                <div class="formGroup mt20 clearFix">
                    <button class="btn regularBtn secondBtn modBtn" type="submit">确认修改</button>
                </div>
            </div>
        </form>
    </div>
</div>
<?php include "footer.php" ;?>
<script type="text/javascript" src="js/account.js"></script>
</body>
</html>