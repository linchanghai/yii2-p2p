<?php
use yii\helpers\Url;
$this->registerCssFile(Yii::$app->urlManager->baseUrl . '/css/invest.min.css', ['depends' => [\frontend\assets\RequireAsset::className()]]);

$this->registerJsFile(Yii::$app->urlManager->baseUrl . '/js/integral.js', ['depends' => [\frontend\assets\RequireAsset::className()]]);

$type = $productMapModel->getTypeArray();
?>
<div class="container mt20 investTitleTop">
    <div class="fl investTitleLeft"><?= $type[$productMapModel->type]?>兑换</div>
    <div class="fr investTitleRight integralTopRight">
        <a class="fr" href="#">更多 ></a>
    </div>
</div>

<?php
if(Yii::$app->session->hasFlash('success')){
    ?>
<div class="container mt20 ">
    <?php
    echo Yii::$app->session->getFlash('success');
    ?>
</div>
<?php
}
?>
<div class="container mt20 couponExchange">
    <div class="fl backGrey showExample">
        <h2 class="textCenter themeColor">钻点<?= $type[$productMapModel->type]?></h2>
        <div class="mt40 integralItemDetail">
            <?= $productMapModel->exchange_value?><?= ($productMapModel->type!=$productMapModel::CouponAnnual)?'元':'%'?>
        </div>
    </div>
    <?php $form = \yii\widgets\ActiveForm::begin([
        'method' => 'post',
        'options'=>['class'=>'fr backGrey exchangeArea'],
    ]) ?>
        <?= \yii\helpers\Html::hiddenInput('id', $productMapModel->product_map_id); ?>
        <h2 class="themeColor">钻点<?= $type[$productMapModel->type]?></h2>
        <div class="mt10"><label class="col666">有效期限: </label><?= $productMapModel->duration?>天</div>
        <div class="mt10"><label class="col666">礼品类型: </label><?= $type[$productMapModel->type]?></div>
        <div class="mt40"><label class="col666">换购积分: </label><span id="leastLine"><?= $productMapModel->exchange_points?></span></div>
        <div class="mt10 clearFix integralArea">
            <label class="fl">换购数量:</label>
            <div class="fl ml10 moneyArea">
                <span class="fl operate minus">-</span>
                <input type="text" name="quantity" value="3" maxlength="9999" class="fl investMoney" />
                <span class="fl operate plus">+</span>
            </div>
        </div>
        <div class="clearFix mt20 myIntegralItem">
            <?= \yii\helpers\Html::submitButton('换购',['class'=>'fl btn regularBtn mr16'])?>
            <div class="fl ml10 myIntegralArea">
                我的积分: <span id="myIntegral" class="themeColor"><?=Yii::$app->user->identity->memberStatistic->points?></span>
            </div>
        </div>
        <div class="mt10">
            <a class="fs12 themeColor" href="#">如何使用?</a>
        </div>
    <?php $form::end() ?>
</div>
<div class="container mt20 backGrey investRule">
    <ul class="clearFix investRuleTap">
        <li class="active">礼品详情</li>
    </ul>
    <div class="investRuleDetail">
        <div class="investSingleRule">
            <table class="table tableNoBorder investSingleRule1">
                <tbody>
                <tr>
                    <td class="textRight">礼品名称</td>
                    <td>钻点<?= $productMapModel->exchange_value?><?= ($productMapModel->type!=$productMapModel::CouponAnnual)?'元':'%'?><?= $type[$productMapModel->type]?></td>
                </tr>
                <tr>
                    <td class="textRight">有效期限</td>
                    <td><?= $productMapModel->duration?>天</td>
                </tr>
                <tr>
                    <td class="textRight">使用方法</td>
                    <td class="secondColor">换购成功后在“我的账户——我的奖励”中查看</td>
                </tr>
                <tr>
                    <td class="textRight">换购条件</td>
                    <td class="secondColor">所有投资用户可换购</td>
                </tr>
                </tbody>
            </table>
        </div>

    </div>
</div>