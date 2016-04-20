<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>Examples</title>
    <meta name="description" content="" />
    <meta name="keywords" content="" />
    <link href="css/style.min.css" rel="stylesheet" />
    <link href="css/about.min.css" rel="stylesheet" />
</head>
<body>
<?php include "header.php" ;?>
<div class="container twoContainer">
    <?php include "aboutSide.php" ;?>
    <div class="containerMain p20 activity">
<!--        3个链接3个页面-->
        <ul class="clearFix aboutTab">
            <li class="fl">
                <a class="active" href="#">正在进行</a>
            </li>
            <li class="fl">
                <a href="#">即将开始</a>
            </li>
            <li class="fl">
                <a href="#">已经结束</a>
            </li>
        </ul>
        <dl class="mt20">
            <dt>
                <a class="fs18 greenColor" href="#">请带走你的红包</a>
            </dt>
            <dd class="mt10">
                <a href="#"><img src="http://www.iqianjin.com/news/u/cms/www/201507/02103654ccgl.jpg" width="760" height="228" alt=""></a>
            </dd>
        </dl>
    </div>
</div>
<?php include "footer.php" ;?>
<script type="text/javascript" src="js/about.js"></script>
</body>
</html>