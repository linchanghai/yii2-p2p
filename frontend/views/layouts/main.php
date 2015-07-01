<?php
use yii\helpers\Html;
use yii\web\YiiAsset;

/* @var $this \yii\web\View */
/* @var $content string */

YiiAsset::register($this);
?>
<?php $this->beginPage() ?>
    <!DOCTYPE html>
    <html lang="<?= Yii::$app->language ?>">
    <head>
        <meta charset="<?= Yii::$app->charset ?>"/>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
        <meta name="description" content=""/>
        <meta name="keywords" content=""/>
        <title><?= Html::encode($this->title) ?></title>
        <?= Html::csrfMetaTags() ?>
        <?php $this->head() ?>
        <?php
        $this->registerCssFile(Yii::$app->urlManager->baseUrl . '/css/style.min.css');
        $this->registerCssFile(Yii::$app->urlManager->baseUrl . '/css/index.min.css');

        $this->registerJsFile(Yii::$app->urlManager->baseUrl . '/js/require.js');
        $this->registerJsFile(Yii::$app->urlManager->baseUrl . '/js/requireApp.js');
        $this->registerJsFile(Yii::$app->urlManager->baseUrl . '/js/index.js');
        ?>
    </head>
    <body>
    <?php $this->beginBody() ?>

    <?= $this->render('header') ?>

    <?= $content ?>

    <?= $this->render('footer') ?>

    <?php $this->endBody() ?>
    </body>
    </html>
<?php $this->endPage() ?>