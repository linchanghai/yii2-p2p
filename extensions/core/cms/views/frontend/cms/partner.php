<div class="containerMain partner">
    <ul>
        <?php foreach($models as $model){?>
            <li class="clearFix mb10">
                <h3 class="mb10 clearFix">
                    <a class="fl" href="<?= \yii\helpers\Url::to(['/cms/cms/partner','id'=>$model->cms_partner_id])?>"><img src="<?= $model->img_icon?>" width="110" height="32" alt="" /></a>
                    <a class="fl ml20" href="<?= \yii\helpers\Url::to(['/cms/cms/partner','id'=>$model->cms_partner_id])?>"><?= $model->title?></a>
                </h3>
                <?= \yii\helpers\HtmlPurifier::process($model->content) ?>
            </li>
        <?php }?>
    </ul>
</div>