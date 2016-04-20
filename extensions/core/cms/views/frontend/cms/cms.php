<?php
use yii\helpers\Url;
?>
<div class="containerMain media">
    <div class="aboutBanner">
        <p class="fs20 textCenter"><?= $model->title?></p>
        <p class="mt10 clearFix titleDes">
            <span>发布时间:<?= date('Y-m-d',$model->create_time)?></span>
            <span>来源:<?= $model->source_site?></span>
            <a href="<?= $model->source_link?>">查看原文</a>
            <a href="<?= Url::to(['/cms/cms/media-list'])?>" class="fr">返回媒体报道列表</a>
        </p>
    </div>
    <div class="aboutContent">
        <?= \yii\helpers\HtmlPurifier::process($model->content) ?>
    </div>
</div>