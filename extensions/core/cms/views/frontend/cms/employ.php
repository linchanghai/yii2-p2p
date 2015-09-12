

    <div class="containerMain p20 employ">
        <div class="aboutBanner fs20 textCenter">
            我们期待您的加入
        </div>
        <?php foreach($models as $model){

            ?>
            <dl class="mt20">
                <dt>
                    <a class="fs18" href="#"><?= $model->title?></a>
                </dt>
                <dd class="mt10">
                    <?= \yii\helpers\HtmlPurifier::process($model->content) ?>
                </dd>
            </dl>
        <?php } ?>
    </div>
