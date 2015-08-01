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
        <form class="backGrey p20 modifyPwd">
            <div class="formGroup clearFix">
                <label for="oldPwd">入旧密码</label>
                <input type="password" id="oldPwd" placeholder="请输入旧密码" />
            </div>
            <div class="formGroup clearFix">
                <label for="password">请输入新密码</label>
                <input type="password" id="password" placeholder="请输入新 密码" />
            </div>
            <div class="formGroup clearFix">
                <label for="confirmPwd">请确认新密码</label>
                <input type="password" id="confirmPwd" placeholder="请确认新密码" />
            </div>
        </form>
    </div>
</div>
<?php include "footer.php" ;?>
<script type="text/javascript" src="js/account.js"></script>
</body>
</html>