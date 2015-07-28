<?php
use yii\helpers\Html;
use yii\helpers\Url;
?>
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
                    <?php if (Yii::$app->user->isGuest) { ?>
                        <?= Html::a('注册', ['/site/signup'], ['class' => 'registerItem']) ?>
                        <label class="split">|</label>
                        <?= Html::a('登录', ['/site/login'], ['class' => 'loginItem']) ?>
                    <?php } else { ?>
                        <a class="userAccount" href="<?= Url::to(['/member/member/index']) ?>">
                            <i class="glyphicon glyphicon-user"></i><?= Yii::$app->user->identity->username ?>
                        </a>
                        <label class="split">|</label>
                        <a class="myMessages" href="#">
                            <i class="glyphicon glyphicon-bell"></i>消息(<?= \kiwi\Kiwi::getMessage()->getUnreadMessageCount() ?>)
                        </a>
                        <label class="split">|</label>
                        <?= Html::a('登出', ['/site/logout'], ['class' => 'loginItem', 'data-method' => 'post']) ?>
                    <?php } ?>
                </span>
                </div>
            </div>
        </div>
        <div class="container headerNav">
            <a class="fl logo" href="#">
                <img src="<?= Yii::$app->urlManager->baseUrl ?>/images/static/logo.png" width="270" height="40"
                     alt=""/>
            </a>

            <div class="fr ulNav">
                <a class="<?= isset($this->params['home']) && $this->params['home'] ? 'active' : '' ?>"
                   href="<?= Url::to(['/']) ?>">首页</a>
                <a class="<?= isset($this->params['project-list']) && $this->params['project-list'] ? 'active' : '' ?>"
                   href="<?= Url::to(['/project/project/list']) ?>">投资项目</a>
                <a href="#">安全保障</a>
                <a href="#">新手指南</a>
                <a href="#">关于我们</a>
            </div>
        </div>
    </div>
</header>