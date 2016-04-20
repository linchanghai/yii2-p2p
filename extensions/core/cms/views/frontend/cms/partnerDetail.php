<?php
use yii\helpers\Url;
?>
<div class="containerMain media">
    <div class="aboutBanner">
        <p class="fs20 textCenter"><?= $model->title?></p>
        <p class="mt10 clearFix titleDes">
            <a href="<?= Url::to(['/cms/cms/partner-list'])?>" class="fr">返回列表</a>
        </p>
    </div>
    <div class="aboutContent">
        <?= \yii\helpers\HtmlPurifier::process($model->content) ?>
    </div>
</div>