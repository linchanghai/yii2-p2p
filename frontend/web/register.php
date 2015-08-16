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
<div class="container backGrey loginWrap">
    <div class="clearFix">
        <div class="fr fs16">没有帐号? <a href="#" class="secondColor">立即注册</a></div>
    </div>
    <form action="" method="post" class="registerForm">
        <div class="formGroup clearFix">
            <label class="fl glyphicon glyphicon-user inputGroupAdd" for="username"></label>
            <input type="text" class="fl formControl" placeholder="用户名" maxlength="20" id="username" name="username" />
            <div class="fl loginError errorColor ml20">
                <i class="glyphicon glyphicon-exclamation-sign"></i>已存在
            </div>
        </div>
        <div class="formGroup mt20 clearFix">
            <label class="fl glyphicon glyphicon-lock inputGroupAdd" for="password"></label>
            <input type="password" class="fl formControl" placeholder="请输入密码" maxlength="20" id="password" name="password" />
            <div class="fl loginError errorColor ml20">
                <i class="glyphicon glyphicon-exclamation-sign"></i>密码格式错误
            </div>
        </div>
        <div class="formGroup mt20 clearFix">
            <label class="fl glyphicon glyphicon-lock inputGroupAdd" for="confirmPwd"></label>
            <input type="password" class="fl formControl" placeholder="请确认输入密码" maxlength="20" id="confirmPwd" name="confirmPwd" />
            <div class="fl loginError errorColor ml20">
                <i class="glyphicon glyphicon-exclamation-sign"></i>两次密码不一致
            </div>
        </div>
        <div class="formGroup mt20 clearFix">
            <label class="fl glyphicon glyphicon-phone inputGroupAdd" for="phone"></label>
            <input type="password" class="fl formControl" placeholder="请输入手机号码" maxlength="11" id="phone" name="confirmPwd" />
            <div class="fl loginError errorColor ml20">
                <i class="glyphicon glyphicon-exclamation-sign"></i>两次密码不一致
            </div>
        </div>
        <div class="formGroup formGroupUnion mt20 clearFix">
            <input type="text" class="fl formControl" />
            <button type="button" class="fr itemInput btn secondBtn" id="codeSend">发送短信验证码</button>
        </div>
        <div class="formGroup mt20 clearFix">
            <button type="submit" class="secondBtn largeBtn loginBtn">立即注册</button>
        </div>

    </form>
</div>
<?php include "footer.php" ;?>
<script type="text/javascript" src="js/account.js"></script>
</body>
</html>