<?php
use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;
$this->registerCssFile(Yii::$app->urlManager->baseUrl . '/css/account.min.css', ['depends' => [\frontend\assets\AppAsset::className()]]);

$this->registerJsFile(Yii::$app->urlManager->baseUrl . '/js/account.js', ['depends' => [\frontend\assets\AppAsset::className()]]);

?>

<div class="containerMain">
    <ul class="clearFix rechargeTitle">
        <li><a class="active" href="<?= Url::to(['/member/member-coupon/bonus-view'])?>">红包券</a></li>
        <li><a  href="<?= Url::to(['/member/member-coupon/cash-view'])?>">现金券</a></li>
        <li><a  href="<?= Url::to(['/member/member-coupon/annual-view'])?>">年化券</a></li>
    </ul>
<?php
echo '已经使用'.$bonus->used_bonus;
echo '未使用'.$bonus->bonus;
foreach($models as $model){

}
?>
    </div>