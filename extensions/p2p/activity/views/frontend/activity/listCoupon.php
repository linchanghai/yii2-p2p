<?php
use yii\helpers\Url;
$this->registerCssFile(Yii::$app->urlManager->baseUrl . '/css/invest.min.css', ['depends' => [\frontend\assets\AppAsset::className()]]);

$this->registerJsFile(Yii::$app->urlManager->baseUrl . '/js/integral.js', ['depends' => [\frontend\assets\AppAsset::className()]]);

$this->params['list-coupon'] = 1;
?>
<div class="indexNotice backGrey" id="textSlider">

    <ul class="container">
        <li>用户: 188 **** 8888 成功领取红包 <label class="themeColor">50</label> 元</li>
        <li>用户: 187 **** 8888 成功领取红包 <label class="themeColor">60</label> 元</li>
        <li>用户: 186 **** 8888 成功领取红包 <label class="themeColor">70</label> 元</li>
        <li>用户: 185 **** 8888 成功领取红包 <label class="themeColor">80</label> 元</li>
        <li>用户: 184 **** 8888 成功领取红包 <label class="themeColor">90</label> 元</li>
    </ul>
</div>
<div class="container integral">
    <dl class="mt20 clearFix integralLine integralToday">
        <dt>
            <img src="<?= Yii::$app->urlManager->baseUrl ?>/images/integral4.png" width="69" height="80" alt=""/>
        <p class="mt10">赚积分</p>
        </dt>
        <dd  class="clearFix">
            <a class="fl integralItem" href="#">
                <img src="<?= Yii::$app->urlManager->baseUrl ?>/images/integral7.png" width="69" height="80" alt=""/>
                <p class="mt10">签到赚积分</p>
            </a>
            <a class="fl integralItem" href="#">
                <img src="<?= Yii::$app->urlManager->baseUrl ?>/images/integral5.png" width="69" height="80" alt=""/>
                <p class="mt10">投资项目送积分</p>
            </a>
            <a class="fl integralItem" href="#">
                <img src="<?= Yii::$app->urlManager->baseUrl ?>/images/integral6.png" width="69" height="80" alt=""/>
                <p class="mt10">新手任务送积分</p>
            </a>
        </dd>
    </dl>
    <dl class="mt20 clearFix integralLine integralNormal">
        <dt>
            <img src="<?= Yii::$app->urlManager->baseUrl ?>/images/integral1.png" width="69" height="80" alt=""/>
        <p class="mt10">红包换购</p>
        </dt>
        <dd class="clearFix">
        <?php
        foreach($CouponBonus as $coupon){
            ?>
            <div class="integralItem">
                <div class="integralItemTitle">钻点红包</div>
                <div class="mt10 integralItemDetail">
                    <?= $coupon->exchange_value?>元
                </div>
                <p class="textLeft mt10"><?= $coupon->exchange_value?>元红包</p>
                <div class="clearFix integralItemBottom">
                    <div class="fl left"><?= $coupon->exchange_points?>分</div>
                        <?= \yii\helpers\Html::a('换购',Url::to(['/activity/activity/view','id'=>$coupon->product_map_id]),['class'=>'fr btn'])?>
                </div>
            </div>
        <?php }

        ?>

        </dd>
    </dl>
    <dl class="mt20 clearFix integralLine integralNormal">
        <dt>
            <img src="<?= Yii::$app->urlManager->baseUrl ?>/images/integral2.png" width="50" height="80" alt=""/>
        <p class="mt10">现金券换购</p>
        </dt>
        <dd class="clearFix">
            <?php
            foreach($CouponCash as $coupon){
                ?>
                <div class="integralItem">

                    <div class="integralItemTitle">钻点现金券</div>
                    <div class="mt10 integralItemDetail">
                        <?= $coupon->exchange_value?>元
                    </div>
                    <p class="textLeft mt10"><?= $coupon->exchange_value?>元现金券</p>
                    <div class="clearFix integralItemBottom">
                        <div class="fl left"><?= $coupon->exchange_points?>分</div>
                        <?= \yii\helpers\Html::a('换购',Url::to(['/activity/activity/view','id'=>$coupon->product_map_id]),['class'=>'fr btn'])?>
                    </div>
                </div>
            <?php }

            ?>
        </dd>
    </dl>
    <dl class="mt20 clearFix integralLine integralNormal integralYear">
        <dt>
            <img src="<?= Yii::$app->urlManager->baseUrl ?>/images/integral3.png" width="127" height="80" alt=""/>
        <p class="mt10">年化券换购</p>
        </dt>
        <dd class="clearFix">
            <?php
            foreach($CouponAnnual as $coupon){
                ?>
                <div class="integralItem">

                    <div class="integralItemTitle">钻点年化券</div>
                    <div class="mt10 integralItemDetail">
                        <?= $coupon->exchange_value?>%年化券
                    </div>
                    <p class="textLeft mt10"><?= $coupon->exchange_value?>%年化券</p>
                    <div class="clearFix integralItemBottom">
                        <div class="fl left"><?= $coupon->exchange_points?>分</div>
                        <?= \yii\helpers\Html::a('换购',Url::to(['/activity/activity/view','id'=>$coupon->product_map_id]),['class'=>'fr btn'])?>
                    </div>
                </div>
            <?php }
            ?>
        </dd>
    </dl>
</div>