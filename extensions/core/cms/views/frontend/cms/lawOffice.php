<div class="containerMain clearFix p20 lawOffice">
    <div class="fl p20 lawOfficeLeft">
        <img class="mb20" src="http://images.iqianjin.com/images/about/consultant.png?v=201508061653" alt="" />
        <h2 class="fs20 mt40">法律顾问</h2>
        <p class="mt10"><?= $model->title?></p>
    </div>
    <div class="fl lawOfficeRight textCenter">
        <?= \yii\helpers\HtmlPurifier::process($model->content) ?>
    </div>
</div>