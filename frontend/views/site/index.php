<?php
use yii\helpers\Url;
/* @var $this yii\web\View */
$this->title = 'My Yii Application';
$this->params['home'] = true;
?>
<div class="banner">
    <ul id="banner">
        <li>
            <a href="#"><img src="<?= Yii::$app->urlManager->baseUrl ?>/images/static/banner1.jpg" alt=""/></a>
        </li>
        <li>
            <a href="#"><img src="<?= Yii::$app->urlManager->baseUrl ?>/images/static/banner2.jpg" alt=""/></a>
        </li>
        <li>
            <a href="#"><img src="<?= Yii::$app->urlManager->baseUrl ?>/images/static/banner3.jpg" alt=""/></a>
        </li>
    </ul>
    <div class="bannerLayer">
        <p class="fs20">
            钻点预期年化收益率
        </p>

        <p class="mt10">
            最高可达 <span class="themeColor fs30">16%</span>
        </p>
        <a class="mt20 btn largeBtn" href="#">马上加入</a>

        <p class="mt10">已有睿智投资人数 <span class="themeColor">99999</span></p>
        <a class="mt10 disb" href="#">
            <i class="glyphicon glyphicon-phone"></i>
            安装手机钻点 随时随地看收益
        </a>
    </div>
</div>
<div class="indexNotice backGrey">
    <div class="container">
        <i class="glyphicon glyphicon-volume-down fs20"></i>
        <a href="#">【钻点公告】 618，全民投资日，你还在观望？</a>
        <a href="#">更多</a>
    </div>
</div>
<div class="container mt20 indexFeature">
    <div class="fl halfArea backTheme indexIconArea">
        <i class="glyphicon glyphicon-lock fl"></i>

        <div class="fl ml20 fs16">
            <a class="colorWhite disb mt10" href="#">钻点是如何做到银行级别的风控？</a>
            <a class="colorWhite disb mt10" href="#">查看详情 ></a>
        </div>
    </div>
    <div class="fl halfArea backGrey textCenter indexIconArea walletArea">
        <img class="disib verB" width="45" height="66" src="<?= Yii::$app->urlManager->baseUrl ?>/images/wallet.png"
             alt=""/>

        <div class="disib ml20 textLeft fs18">
            <a class="themeColor disb" href="#">钻点钱包</a>
            <a class="themeColor disb mt10" href="#">查看详情 > </a>
        </div>
    </div>
</div>
<div class="indexList container">
    <div class="fl indexPro">
        <div class="clearFix mt20 indexProduct">
            <div class="fl textCenter secondBack colorWhite indexProductBrief">
                <img src="<?= Yii::$app->urlManager->baseUrl ?>/images/indexPro1.png" width="42" height="73" alt=""/>

                <p class="mt20">短期项目</p>
            </div>
            <div class="fl backGrey pt20 indexProWrap">
                <?php $projectModels = \kiwi\Kiwi::getProject()->find()->andWhere(['<=','repayment_date',time()+30*24*3600])->limit(3)->all();
                foreach($projectModels as $projectModel){
                ?>
                <div class="fl indexProList">
                    <div class="proTitle col333 textCenter fs16">
                       <?= $projectModel->project_name?>
                    </div>
                    <p class="fs12 mt10 indexProDetail"><?= $projectModel->projectDetails->project_introduce?></p>

                    <div class="progress mt20">
                        <div class="progress-bar progress-bar-striped" style="width: 10%;"></div>
                    </div>
                    <a class="mt10 disb indexBuy" href="<?= Url::to(['project/project/details','id'=>$projectModel->project_id])?>">立即加入</a>
                </div>
                <?php } ?>
            </div>
        </div>
        <div class="clearFix mt20 indexProduct">
            <div class="fl textCenter secondBack colorWhite indexProductBrief">
                <img src="<?= Yii::$app->urlManager->baseUrl ?>/images/indexPro2.png" width="97" height="73" alt=""/>

                <p class="mt20">长期项目</p>
            </div>
            <div class="fl backGrey pt20 indexProWrap">
                <?php $projectModels = \kiwi\Kiwi::getProject()->find()->andWhere(['>','repayment_date',time()+30*24*3600])->limit(3)->all();
                foreach($projectModels as $projectModel){
                    ?>
                    <div class="fl indexProList">
                        <div class="proTitle col333 textCenter fs16">
                            <?= $projectModel->project_name?>
                        </div>
                        <p class="fs12 mt10 indexProDetail"><?= $projectModel->projectDetails->project_introduce?></p>

                        <div class="progress mt20">
                            <div class="progress-bar progress-bar-striped" style="width: 10%;"></div>
                        </div>
                        <a class="mt10 disb indexBuy" href="<?= Url::to(['project/project/details','id'=>$projectModel->project_id])?>">立即加入</a>
                    </div>
                <?php } ?>
            </div>
        </div>
        <div class="clearFix mt20 indexProduct">
            <div class="fl textCenter secondBack colorWhite indexProductBrief">
                <img src="<?= Yii::$app->urlManager->baseUrl ?>/images/indexPro3.png" width="64" height="72" alt=""/>

                <p class="mt20">转让项目</p>
            </div>
            <div class="fl backGrey pt20 indexProWrap">
                <div class="fl indexProList">
                    <div class="proTitle col333 textCenter fs16">
                        汽车宝
                    </div>
                    <p class="fs12 mt10 indexProDetail">本项目为个人贷款产品本项目为个人贷款产品本项目为个人贷款产品</p>

                    <div class="progress mt20">
                        <div class="progress-bar progress-bar-striped" style="width: 10%;"></div>
                    </div>
                    <a class="mt10 disb indexBuy" href="#">立即加入</a>
                </div>
                <div class="fl indexProList">
                    <div class="proTitle col333 textCenter fs16">
                        汽车宝
                    </div>
                    <p class="fs12 mt10 indexProDetail">本项目为个人贷款产品本项目为个人贷款产品本项目为个人贷款产品</p>

                    <div class="progress mt20">
                        <div class="progress-bar parogress-succeed progress-bar-striped" style="width: 100%;"></div>
                    </div>
                    <a class="mt10 disb indexBuy" href="#">立即加入</a>
                </div>
                <div class="fl indexProList">
                    <div class="proTitle col333 textCenter fs16">
                        汽车宝
                    </div>
                    <p class="fs12 mt10 indexProDetail">本项目为个人贷款产品本项目为个人贷款产品本项目为个人贷款产品</p>

                    <div class="progress mt20">
                        <div class="progress-bar progress-bar-striped" style="width: 50%;"></div>
                    </div>
                    <a class="mt10 disb indexBuy" href="#">立即加入</a>
                </div>
            </div>
        </div>
    </div>
    <div class="fr siteArea">
        <div class="mt20 siteItem">
            <div class="fl siteItemLeft">
                <i class="glyphicon glyphicon-gift"></i>
            </div>
            <div class="fl siteItemRight">
                <a href="#">秒赚 <span class="secondColor">50元</span>红包</a>
                <a class="mt10 btn secondBtn" href="#">动动手指</a>
            </div>
        </div>
        <div class="mt20 siteItem">
            <div class="fl siteItemLeft">
                <i class="glyphicon glyphicon-usd"></i>
            </div>
            <div class="fl siteItemRight">
                <a href="#">充值</a>
                <a class="mt10 btn themeColor" href="<?= Url::to(['/recharge/recharge/recharge'])?>">充值</a>
            </div>
        </div>
        <div class="mt20 siteItem">
            <div class="fl siteItemLeft">
                <i class="glyphicon glyphicon-save"></i>
            </div>
            <div class="fl siteItemRight">
                <a href="#">签到赚积分</a>
                <?php \yii\widgets\Pjax::begin();?>
                <?php \yii\widgets\ActiveForm::begin([
                    'method'=>'post',
                    'action'=>Url::to(['activity/activity/sign']),
                    'options' => ['data-pjax' => 1]
                ]) ;
                echo \kartik\helpers\Html::submitButton('签到',['class'=>"mt10 btn secondBtn" ]);
                \yii\widgets\ActiveForm::end();
                ?>
                <?php \yii\widgets\Pjax::end();?>
            </div>
        </div>
        <div class="mt20 siteItem">
            <div class="fl siteItemLeft">
                <i class="glyphicon glyphicon-calendar"></i>
            </div>
            <div class="fl siteItemRight">
                <a href="#">年化收益率最高可达 <span class="secondColor">16%</span></a>
                <a class="mt10 btn themeColor" href="#">收益计算器</a>
            </div>
        </div>
        <div class="mt20 siteItem textCenter siteItemLast">
            <a href="#"><img src="<?= Yii::$app->urlManager->baseUrl ?>/images/static/200_100.png" alt=""/></a>
            <a class="mt20 fs16 disb themeColor" href="#">活动专场</a>
        </div>
    </div>
</div>
<div class="container mt20 backGrey">
    <div class="fl textCenter customerService">
        <h3 class="fs18">客户服务</h3>

        <p class="mt10">用心为您</p>
    </div>
    <div class="fl indexOperate">
        <a class="operateItem" href="#">
            <p><i class="glyphicon glyphicon-comment"></i></p>

            <p class="mt10">在线咨询</p>
        </a>
        <a class="operateItem" href="#">
            <p><i class="glyphicon glyphicon-list-alt"></i></p>

            <p class="mt10">充值提现</p>
        </a>
        <a class="operateItem" href="#">
            <p><i class="glyphicon glyphicon-yen"></i></p>

            <p class="mt10">我要理财</p>
        </a>
        <a class="operateItem" href="#">
            <p><i class="glyphicon glyphicon-hdd"></i></p>

            <p class="mt10">平台介绍</p>
        </a>
        <a class="operateItem" href="#">
            <p><i class="glyphicon glyphicon-file"></i></p>

            <p class="mt10">优惠券使用</p>
        </a>
        <a class="operateItem" href="#">
            <p><i class="glyphicon glyphicon-repeat"></i></p>

            <p class="mt10">还款方式</p>
        </a>
    </div>
</div>
<div class="container mt20 backGrey">
    <div class="fl textCenter fs18 customerService cooperate">
        合作伙伴
    </div>
    <div class="cooperateMate">
        <a href="#" class="cooperateMateItem">
            <img src="<?= Yii::$app->urlManager->baseUrl ?>/images/static/c1.png" alt=""/>
        </a>
        <a href="#" class="cooperateMateItem">
            <img src="<?= Yii::$app->urlManager->baseUrl ?>/images/static/c2.png" alt=""/>
        </a>
        <a href="#" class="cooperateMateItem">
            <img src="<?= Yii::$app->urlManager->baseUrl ?>/images/static/c3.png" alt=""/>
        </a>
        <a href="#" class="cooperateMateItem">
            <img src="<?= Yii::$app->urlManager->baseUrl ?>/images/static/c1.png" alt=""/>
        </a>
        <a href="#" class="cooperateMateItem">
            <img src="<?= Yii::$app->urlManager->baseUrl ?>/images/static/c2.png" alt=""/>
        </a>
        <a href="#" class="cooperateMateItem">
            <img src="<?= Yii::$app->urlManager->baseUrl ?>/images/static/c3.png" alt=""/>
        </a>
    </div>
</div>
