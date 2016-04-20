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
            <li><a class="active" href="#">登录密码</a></li>
            <li><a href="#">交易密码</a></li>
        </ul>
        <form class="backGrey p20 modifyPwdForm" id="modifyPwd">
            <div class="formGroup mt20 clearFix">
                <label class="fl modLabel" for="oldPwd">输入旧密码</label>
                <input class="fl modInput" type="password" id="oldPwd" placeholder="请输入旧密码" />
                <div class="fl loginError errorColor ml20">
                    <i class="glyphicon glyphicon-exclamation-sign"></i>密码错误
                </div>
            </div>
            <div class="formGroup mt20 clearFix">
                <label class="fl modLabel" for="password">请输入新密码</label>
                <input class="fl modInput" type="password" id="password" placeholder="请输入新密码" />
                <div class="fl loginError errorColor ml20">
                    <i class="glyphicon glyphicon-exclamation-sign"></i>两次密码不一致
                </div>
            </div>
            <div class="formGroup mt20 clearFix">
                <label class="fl modLabel" for="confirmPwd">请确认新密码</label>
                <input class="fl modInput" type="password" id="confirmPwd" placeholder="请确认新密码" />
            </div>
            <div class="formGroup mt20 clearFix">
                <button class="btn regularBtn secondBtn modBtn" type="submit">确认修改</button>
            </div>

        </form>
    </div>
</div>
<?php include "footer.php" ;?>
<script type="text/javascript" src="js/account.js"></script>
</body>
</html>