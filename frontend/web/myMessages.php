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
    <div class="containerMain backGrey myMessages">
        <div class="myMessageTitle itemTitle fs16 clearFix">
            <div class="fl">
                消息
            </div>
            <a href="#" class="fr">
                全部标记为已读
            </a>
        </div>
        <table class="table table-hover messagesTable">
            <tbody>
                <tr>
                    <td class="messageLeft">
                        <input type="checkbox" class="prt2 msgCheck" />购买爱月投成功
                        <div class="messageContent mt10">
                            您于您于您于您于您于您于您于您于您于您于
                        </div>
                    </td>
                    <td class="messageRight originDate">2015-07-07 07:07:07</td>
                    <td class="messageRight removeMsg secondColor">
                        <a class="secondColor" href="#">删除 ×</a>
                        <p class="textRight insideDate mt10">2015-07-07 07:07:07</p>
                    </td>
                </tr>
                <tr>
                    <td class="messageLeft">
                        <input type="checkbox" class="prt2 msgCheck" />购买爱月投成功
                        <div class="messageContent mt10">
                            您于您于您于您于您于您于您于您于您于您于
                        </div>
                    </td>
                    <td class="messageRight originDate">2015-07-07 07:07:07</td>
                    <td class="messageRight removeMsg secondColor">
                        <a class="secondColor" href="#">删除 ×</a>
                        <p class="textRight insideDate mt10">2015-07-07 07:07:07</p>
                    </td>
                </tr>
            </tbody>
        </table>
        <div class="myMessageBottom itemTitle itemBottom clearFix">
            <div class="fl">
                <label for="allMsg"><input type="checkbox" id="allMsg" class="prt2">全选</label>
                <a class="secondColor" href="#">标记为已读</a>
                <a class="secondColor" href="#">删除</a>
            </div>
        </div>
    </div>
</div>
<?php include "footer.php" ;?>
<script type="text/javascript" src="js/account.js"></script>
</body>
</html>