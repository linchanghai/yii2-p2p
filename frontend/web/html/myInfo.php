<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>Examples</title>
    <meta name="description" content="" />
    <meta name="keywords" content="" />
    <link href="css/style.min.css" rel="stylesheet" />
    <link href="css/invest.min.css" rel="stylesheet" />
    <link href="css/account.min.css" rel="stylesheet" />
</head>
<body>
<?php include "header.php" ;?>
<div class="container twoContainer">
    <?php include "accountSide.php" ;?>
    <div class="containerMain backGrey">
        <div class="itemTitle">
            基本信息
        </div>
        <div class="clearFix myInfo">
            <table class="table ">
                <tbody>
                    <tr>
                        <td class="textRight">用户名</td>
                        <td>呵呵</td>
                        <td><a href="#" class="themeColor">修改</a></td>
                    </tr>
                    <tr>
                        <td class="textRight">邮箱</td>
                        <td>188 **** 8888</td>
                        <td><a href="#" class="themeColor">修改</a></td>
                    </tr>
                    <tr>
                        <td class="textRight">手机</td>
                        <td>未绑定</td>
                        <td><a href="#" class="themeColor">绑定</a></td>
                    </tr>
                    <tr>
                        <td class="textRight">真实姓名</td>
                        <td>未设置</td>
                        <td><a href="#" class="themeColor">设置</a></td>
                    </tr>
                    <tr>
                        <td class="textRight">身份证</td>
                        <td>33**************11</td>
                        <td><span class="glyphicon glyphicon-ok themeColor"></span></td>
                    </tr>
                </tbody>
            </table>
            <div class="mt20 p20 textCenter">
                <span class="glyphicon glyphicon-info-sign themeColor"></span>
                因个人信息涉及到发生购买行为的合同有效性,故个人信息不可修改
            </div>
        </div>
    </div>
</div>
<?php include "footer.php" ;?>
<script type="text/javascript" src="js/account.js"></script>
</body>
</html>