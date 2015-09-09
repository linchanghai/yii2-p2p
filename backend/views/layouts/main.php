<?php

use backend\assets\AppAsset;
use kiwi\Kiwi;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\Breadcrumbs;

/**
 * @var \yii\web\View $this
 * @var string $content
 */

AppAsset::register($this);

$menus = Kiwi::getConfiguration()->menus;
?>

<?php $this->beginPage() ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
    "http://www.w3.org/TR/html4/loose.dtd">
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>管理后台</title>
    <?= Html::csrfMetaTags() ?>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="main-header navbar-fixed-top">
    <div class="pull-left" style="position: fixed; top: 21px">
        <img src="<?= Yii::$app->urlManager->baseUrl ?>/images/logo.png"/>
    </div>
    <div class="nav-left">
        <span style="color:#ffffff;"><?= Yii::$app->user->isGuest ? Html::a('登录', ['site/login']) : Yii::$app->user->identity->username . '您好!'; ?></span>
        &nbsp; |
        <a href="/" target="_blank">查看前台</a> |
        <a href="javascript:click(location.reload())">刷新</a> |
        <a href="javascript:void(0)">清空缓存</a> |
        <a href="<?= Url::to(['site/logout']) ?>" data-method="post">退出</a><br/>

        <div id="TopTime"></div>
    </div>
    <div class="main-menu">
        <ul class="nav nav-tabs">
            <?php foreach ($menus as $key => $menu) {
                $class = isset($menu['active']) ? 'active' : 'normal';
                echo Html::tag('li', Html::a($menu['label'], $menu['url']), ['class' => $class]);
            } ?>
        </ul>
    </div>
</div>
<div class="left-menu">
    <?php
    foreach ($menus as $menuKey => $menu) {
        if (!isset($menu['active'])) {
            continue;
        }
        if (isset($menu['items'])) {
            foreach ($menu['items'] as $groupKey => $itemGroup) { ?>
                <div>
                    <div class="label-menu" data-toggle="collapse" data-target="#<?= $groupKey ?>" aria-expanded="true"
                         aria-controls="<?= $groupKey ?>" style="cursor: pointer;">
                        <?= $itemGroup['label'] ?>
                        <i class="glyphicon glyphicon-minus-sign"></i>
                    </div>

                    <div class="clearfix"></div>
                    <ul id="<?= $groupKey ?>" class="collapse in">
                        <?php foreach ($itemGroup['items'] as $itemKey => $item) {
                            $class = isset($item['active']) ? 'current' : '';
                            $label = isset($item['active']) ? '<i class="glyphicon glyphicon-arrow-right"></i>' : '';
                            $html = Html::a($label . $item['label'], $item['url']);
                            echo Html::tag('li', $html, ['class' => $class]);
                        }
                        ?>
                    </ul>
                </div>
            <?php }
        }
    }
    ?>
</div>
<div class="content">
    <?= Breadcrumbs::widget(['links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],]) ?>
    <?= \frontend\widgets\Alert::widget() ?>
    <?= $content ?>
</div>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
