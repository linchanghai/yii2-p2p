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
                    <li>
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
                <div class="formGroup mt20 clearFix">
                    <label class="fl modLabel" for="phone">账户信息</label>
                    <input class="fl modInput" type="text" id="phone" placeholder="请填写用户名、邮箱或手机" />
                    <div class="fl loginError errorColor ml20">
                        <i class="glyphicon glyphicon-exclamation-sign"></i>无此账户
                    </div>
                </div>
                <div class="formGroup formGroupUnion mt20 clearFix">
                    <label class="fl modLabel" for="validCode">验证码</label>
                    <input type="text" class="fl formControl modInput"/>
                    <img class="fl curp" src="http://placehold.it/70x34" alt="" width="70" height="34" />
                    <span class="fl curp secondColor mt6 ml10">看不清换一张</span>
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