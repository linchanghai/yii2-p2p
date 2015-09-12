<div class="containerMain p20 aboutUs">
    <div class="aboutBanner fs20 textCenter">
        关于我们
    </div>
    <?= \yii\helpers\HtmlPurifier::process($model->content) ?>
</div>