<div class="containerMain p20 aboutUs">
    <div class="aboutBanner fs20 textCenter">
        专家顾问
    </div>
    <ul class="hoverItem clearFix mt20">
        <?php
        $i= 0;
        foreach($models as $model){
            ?>
            <li class="<?= $i==0 ? 'activeHover':''?>">
                <img src="<?= $model->img?>" alt="" />
                <span class="topArrow"></span>
            </li>
            <?php $i++;} ?>
    </ul>
    <ul class="hoverContent">
        <?php
        $i= 0;
        foreach($models as $model){
            ?>
            <li class="hoverSingle <?= $i==0 ? '':'hide'?>">
                <?= \yii\helpers\HtmlPurifier::process($model->content) ?> </li>
            <?php $i++;} ?>
    </ul>
</div>