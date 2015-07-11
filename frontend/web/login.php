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
<div class="backGrey">
    <div class="container loginWrap">
        <div class="clearFix">
            <div class="fr fs16">没有帐号? <a href="#" class="secondColor">立即注册</a></div>
        </div>
        <form action="" method="post">
            <div class="formGroup clearFix">
                <label class="fl glyphicon glyphicon-user inputGroupAdd" for="username"></label>
                <input type="text" class="fl formControl" placeholder="用户名" maxlength="20" id="username" name="username" />
                <div class="fl loginError errorColor ml20">
                    <i class="glyphicon glyphicon-exclamation-sign"></i>用户名或密码错误
                </div>
            </div>
            <div class="formGroup mt20 clearFix">
                <label class="fl glyphicon glyphicon-lock inputGroupAdd" for="username"></label>
                <input type="password" class="fl formControl" placeholder="请输入密码" maxlength="20" id="password" name="password" />
            </div>
            <div class="formGroup mt20 clearFix">
                <label class="fl rememberMe" for="rememberMe"><input type="checkbox" class="prt2" id="rememberMe" name="rememberMe" checked>记住我</label>
                <a class="fl findPasswordLink themeColor">忘记密码?</a>
            </div>
            <div class="formGroup mt20 clearFix">
                <button type="submit" class="secondBtn largeBtn loginBtn">立即登录</button>
            </div>
            <div class="formGroup mt20">
                <i class="glyphicon glyphicon-ok-sign secondColor"></i>您的信息已使用SSL加密技术，数据传输安全
            </div>
        </form>
    </div>
</div>
<?php include "footer.php" ;?>
<script type="text/javascript" src="js/account.js"></script>
</body>
</html>