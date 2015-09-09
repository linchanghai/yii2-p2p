<div class="containerMain p20 media">
    <ul>
        <?php foreach($models as $model){?>
        <li class="clearFix mb10">
            <div class="fl mediaLeft">
                <a href="#">
                    <img src="http://www.iqianjin.com/news/u/cms/www/201507/30135140koia.png" width="145" height="45" alt="" />
                </a>
            </div>
            <div class="fr mediaRight">
                <h4><a href="<?= \yii\helpers\Url::to(['/cms/cms/media','id'=>$model->cms_media_id])?>"><?= $model->title?></a></h4>
                <p>
                    <?= \yii\helpers\HtmlPurifier::process($model->content) ?>
                    <a href="<?= \yii\helpers\Url::to(['/cms/cms/media','id'=>$model->cms_media_id])?>" class="fr greenColor">查看详情</a>
                </p>
            </div>
        </li>
        <?php }?>


    </ul>
    <div class="mt20 textCenter">
        <?= \yii\widgets\LinkPager::widget([
            'pagination' => $pages,
            'options' => ['class' => 'pagination pags']
        ]); ?>
    </div>
</div>