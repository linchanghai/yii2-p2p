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
                <li><a href="<?= Url::to(['cms/cms/about','title'=>'关于我们'])?>">关于我们</a></li>
                <li class="aboutSub active"><a href="<?= Url::to(['cms/cms/about','title'=>'团队介绍'])?>">团队介绍</a></li>
                <li class="aboutSub"><a href="<?= Url::to(['cms/cms/about','title'=>'资质荣誉'])?>">资质荣誉</a></li>
                <li class="aboutSub"><a href="<?= Url::to(['cms/cms/about','title'=>'专家顾问'])?>">专家顾问</a></li>
                <li class="aboutSub"><a href="<?= Url::to(['cms/cms/about','title'=>'法律顾问'])?>">法律顾问</a></li>
                <li><a href="<?= Url::to(['/cms/cms/media-list'])?>">媒体报道</a></li>
                <li><a href="#">合作伙伴((后台没有))</a></li>
                <li><a href="#">官方公告(没皮)</a></li>
                <li><a href="#">活动公告(前后都没有)</a></li>
                <li><a href="<?= Url::to(['cms/cms/law'])?>">诚聘英才</a></li>
                <li><a href="<?= Url::to(['cms/cms/law'])?>">安全保障</a></li>
                <li><a href="<?= Url::to(['/cms/cms/contact'])?>">联系我们</a></li>
            </ul>
        </div>
        <?= $content; ?>
    </div>

<?php
$this->endContent();
?>