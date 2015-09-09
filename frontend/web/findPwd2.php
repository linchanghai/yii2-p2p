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
                    <li>
                        <div class="ui-step-line">-</div>
                        <div class="ui-step-icon">
                            <i class="iconfont"></i>
                            <i class="ui-step-number">3</i>
                            <span class="ui-step-text">重置密码</span>
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
                <h2 class="textCenter mb20">已将短信验证码发送到您 <span class="secondColor">186****0072</span> 的手机当中，请注意查收！</h2>
                <div class="formGroup formGroupUnion mt20 clearFix" id="findPwdCode">
                    <label class="fl modLabel" for="validCode">请输入验证码</label>
                    <input type="text" class="fl formControl modInput"/>
                    <button type="button" class="fl itemInput btn secondBtn btnDisabled" disabled id="codeSend">重新发送60s</button>
                    <div class="fl loginError errorColor ml20">
                        <i class="glyphicon glyphicon-exclamation-sign"></i>验证码错误
                    </div>
                </div>

                <div class="formGroup mt20 clearFix">
                    <button class="btn regularBtn secondBtn modBtn" type="submit">下一步</button>
                </div>
            </div>
        </form>
    </div>
</div>
<?php include "footer.php" ;?>
<script type="text/javascript" src="js/account.js"></script>
</body>
</html>