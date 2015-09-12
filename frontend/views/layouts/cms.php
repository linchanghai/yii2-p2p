<?php
use yii\helpers\Url;
use frontend\assets\AppAsset;
use \Yii;

$this->beginContent('@app/views/layouts/main.php');
$this->registerCssFile('/css/style.min.css', ['depends' => [AppAsset::className()]]);
$this->registerCssFile('/css/about.min.css', ['depends' => [AppAsset::className()]]);
$this->registerJsFile('/js/about.js', ['depends' => [AppAsset::className()]]);

?>
    <div class="container twoContainer">
        <div class="containerSide aboutSide backGrey">
            <ul>
                <li><a href="<?= Url::to(['/cms/cms/about'])?>">关于我们</a></li>
                <li class="aboutSub active"><a href="<?= Url::to(['/cms/cms/team'])?>">团队介绍</a></li>
                <li class="aboutSub"><a href="<?= Url::to(['/cms/cms/about'])?>">资质荣誉(没皮)</a></li>
                <li class="aboutSub"><a href="<?= Url::to(['/cms/cms/experts'])?>">专家顾问</a></li>
                <li class="aboutSub"><a href="<?= Url::to(['/cms/cms/law-office'])?>">法律顾问</a></li>
                <li><a href="<?= Url::to(['/cms/cms/media-list'])?>">媒体报道</a></li>
                <li><a href="<?= Url::to(['/cms/cms/partner-list'])?>">合作伙伴 </a></li>
                <li><a href="<?= Url::to(['/cms/cms/announcement'])?>">官方公告</a></li>
                <li><a href="#">活动公告(前后都没有)</a></li>
                <li><a href="<?= Url::to(['/cms/cms/employ'])?>">诚聘英才</a></li>
                <li><a href="<?= Url::to(['/cms/cms/law'])?>">安全保障</a></li>
                <li><a href="<?= Url::to(['/cms/cms/contact'])?>">联系我们</a></li>
            </ul>
        </div>
        <?= $content; ?>
    </div>

<?php
$this->endContent();
?>