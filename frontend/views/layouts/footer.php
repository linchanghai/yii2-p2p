<?php
use yii\helpers\Url;
?>
<footer>
    <div class="mt10 footer">
        <div class="container">
            <div class="fl footerHot">
                <i class="glyphicon glyphicon-phone-alt"></i>

                <p class="mt10 fs20">
                    400-0574-0574
                </p>
            </div>
            <ul class="fl footerMenuWrap">
                <li class="fl footerMenu">
                    <a href="<?= Url::to(['cms/cms/about','title'=>'关于我们'])?>">关于我们</a>
                    <a href="<?= Url::to(['cms/cms/about','title'=>'平台介绍'])?>">平台介绍</a>
                    <a href="<?= Url::to(['cms/cms/about','title'=>'法律法规'])?>">法律法规</a>
                    <a href="<?= Url::to(['cms/cms/about','title'=>'安全保障'])?>">安全保障</a>
                </li>
                <li class="fl footerMenu">
                    <a href="<?= Url::to(['cms/cms/about','title'=>'新手指南'])?>">新手指南</a>
                    <a href="#">官方论坛</a>
                    <a href="<?= Url::to(['cms/cms/about','title'=>'名词解释'])?>">名词解释</a>
                    <a href="<?= Url::to(['cms/cms/about','title'=>'理财知识'])?>">理财知识</a>
                </li>
                <li class="fl footerMenu">
                    <a href="<?= Url::to(['cms/cms/contact'])?>">联系我们</a>
                    <a href="#">诚聘英才</a>
                    <a href="#">友情链接</a>
                    <a href="#">网站地图</a>
                </li>
            </ul>
            <ul class="fr mobileFooter">
                <li>
                    <img src="<?= Yii::$app->urlManager->baseUrl ?>/images/static/qr85.png" width="85" height="85"
                         alt=""/>

                    <p class="mt10">
                        关注爱钱进微信
                    </p>
                </li>
                <li>
                    <img src="<?= Yii::$app->urlManager->baseUrl ?>/images/static/qr85.png" width="85" height="85"
                         alt=""/>

                    <p class="mt10">
                        手机点钻
                    </p>
                </li>
            </ul>
        </div>
    </div>
    <div class="copyrightFooter">
        <div class="container">
            <div class="fl">
                ©Copyright(c)2014 dianzuan.com.All Rights Reserved
            </div>
            <div class="fr">
                浙ICP备14099887
            </div>
        </div>
    </div>
</footer>