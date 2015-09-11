<div class="containerMain announcement">
    <ul>
        <?php foreach($models as $model){?>
            <li class="mb10">
                <a href="<?= \yii\helpers\Url::to(['/cms/cms/announcement-detail','id'=>$model->cms_notice_id])?>">
                    <span class="mr16"><?= date('Y-m-d',$model->create_time)?></span>
                    <?= $model->title?>
                </a>
            </li>
        <?php }?>
    </ul>
</div>