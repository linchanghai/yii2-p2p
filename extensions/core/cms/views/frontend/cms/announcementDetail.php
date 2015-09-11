<?php
use yii\helpers\Url;
?>
<div class="containerMain media">
    <div class="aboutBanner">
        <p class="fs20 textCenter"><?= $model->title?></p>
        <p class="mt10 clearFix titleDes">
            <span>发布时间:<?= date('Y-m-d',$model->create_time)?></span>

            <a href="<?= Url::to(['/cms/cms/announcement'])?>" class="fr">返回官方公告列表</a>
        </p>
    </div>
    <div class="aboutContent">
        <?= \yii\helpers\HtmlPurifier::process($model->content) ?>
    </div>
</div>