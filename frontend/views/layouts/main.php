<?php
use yii\helpers\Html;
use frontend\assets\AppAsset;

/* @var $this \yii\web\View */
/* @var $content string */

//AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="description" content="" />
    <meta name="keywords" content="" />
    <title><?= Html::encode($this->title) ?></title>
    <?= Html::csrfMetaTags() ?>
    <?php $this->head() ?>
    <?php
    $this->registerCssFile(Yii::$app->urlManager->baseUrl . '/css/style.min.css');
    $this->registerCssFile(Yii::$app->urlManager->baseUrl . '/css/index.min.css');

    $this->registerJsFile(Yii::$app->urlManager->baseUrl . '/js/index.js');
    $this->registerJsFile(Yii::$app->urlManager->baseUrl . '/js/require.js');
    $this->registerJsFile(Yii::$app->urlManager->baseUrl . '/js/requireApp.js');
    ?>
</head>
<body>
    <?php $this->beginBody() ?>
    <header>
        <div class="topNotice">
            <div class="container">
                <span>系统维护</span>
            </div>
        </div>
        <div class="header">
            <div class="headerTools">
                <div class="container">
                    <a class="fl" href="#">
                        <i class="glyphicon glyphicon-phone"></i>手机钻点
                    </a>
                    <div class="fr headerRight">
                        <a class="hotLine" href="javascript:void(0);">
                            <i class="glyphicon glyphicon-earphone"></i>400-0574-0574 (9:00-21:00)
                        </a>
                        <a class="customer" href="#">
                            <i class="glyphicon glyphicon-envelope"></i>在线客服
                        </a>
                <span class="loginArea">
                    <a class="registerItem" href="#">注册</a>
                    <label class="split">|</label>
                    <a class="loginItem" href="#">登录</a>
                </span>
                        <!--                logined begin-->
                        <!--                <a class="myMessages" href="#">-->
                        <!--                    <i class="glyphicon glyphicon-bell"></i>消息-->
                        <!--                </a>-->
                        <!--                <a class="userAccount" href="#">-->
                        <!--                    <i class="glyphicon glyphicon-user"></i>用户-->
                        <!--                </a>-->
                        <!--                logined end-->
                    </div>
                </div>
            </div>
            <div class="container headerNav">
                <a class="fl logo" href="#">
                    <img src="<?= Yii::$app->urlManager->baseUrl ?>/images/static/logo.png" width="270" height="40" alt=""/>
                </a>
                <div class="fr ulNav">
                    <a class="active" href="#">首页</a>
                    <a href="#">投资项目</a>
                    <a href="#">安全保障</a>
                    <a href="#">新手指南</a>
                    <a href="#">关于我们</a>
                </div>
            </div>
        </div>
    </header>

    <?= $content ?>

    <footer>
        <div class="mt10 footer">
            <div class="container">
                <div class="fl footerHot">
                    <i class="glyphicon glyphicon-phone-alt"></i>
                    <p class="mt10 fs20">
                        400-0574-0574
                    </p>
                </div>
                <ul class="fl footerMenuWrap">
                    <li class="fl footerMenu">
                        <a href="#">关于我们</a>
                        <a href="#">平台介绍</a>
                        <a href="#">法律法规</a>
                        <a href="#">安全保障</a>
                    </li>
                    <li class="fl footerMenu">
                        <a href="#">新手指南</a>
                        <a href="#">官方论坛</a>
                        <a href="#">名词解释</a>
                        <a href="#">理财知识</a>
                    </li>
                    <li class="fl footerMenu">
                        <a href="#">联系我们</a>
                        <a href="#">诚聘英才</a>
                        <a href="#">友情链接</a>
                        <a href="#">网站地图</a>
                    </li>
                </ul>
                <ul class="fr mobileFooter">
                    <li>
                        <img src="<?= Yii::$app->urlManager->baseUrl ?>/images/static/qr85.png" width="85" height="85" alt=""/>
                        <p class="mt10">
                            关注爱钱进微信
                        </p>
                    </li>
                    <li>
                        <img src="<?= Yii::$app->urlManager->baseUrl ?>/images/static/qr85.png" width="85" height="85" alt=""/>
                        <p class="mt10">
                            手机点钻
                        </p>
                    </li>
                </ul>
            </div>
        </div>
        <div class="copyrightFooter">
            <div class="container">
                <div class="fl">
                    ©Copyright(c)2014 dianzuan.com.All Rights Reserved
                </div>
                <div class="fr">
                    浙ICP备14099887
                </div>
            </div>
        </div>
    </footer>

    <?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>