<div class="containerMain p20 law">
    <div class="aboutBanner fs20 textCenter">
        用户在钻点上合法投资理财的收益受法律保护
    </div>
    <ul class="lawLine">
        <?php foreach($models as $model){

        ?>
        <li class="mt20">
            <h3><?= $model->title?> <span class="ml20 greenColor">明确合法</span></h3>
            <p class="mt10">
                <?= \yii\helpers\HtmlPurifier::process($model->content) ?>
            </p>
        </li>
        <?php } ?>

    </ul>
</div>