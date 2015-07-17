<?php
use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;
$this->registerCssFile(Yii::$app->urlManager->baseUrl . '/css/account.min.css', ['depends' => [\frontend\assets\AppAsset::className()]]);

$this->registerJsFile(Yii::$app->urlManager->baseUrl . '/js/account.js', ['depends' => [\frontend\assets\AppAsset::className()]]);

?>

<div class="containerMain">
    <ul class="clearFix rechargeTitle">
        <li><a  href="<?= Url::to(['/member/member-coupon/bonus-view'])?>">红包券</a></li>
        <li><a  href="<?= Url::to(['/member/member-coupon/cash-view'])?>">现金券</a></li>
        <li><a  class="active" href="<?= Url::to(['/member/member-coupon/annual-view'])?>">年化券</a></li>
    </ul>
    <?= Html::a('已使用',['/member/member-coupon/annual-view','status'=>1])?>
    <?= Html::a('未使用',['/member/member-coupon/annual-view','status'=>0])?>
    <br>
<?php
foreach($models as $model){
    echo '过期时间:'.date('Y-m-d H:i:s',$model->expire_date).'<br>';
    echo '使用时间:'.(($model->used_time==0)?'未使用':date('Y-m-d H:i:s',$model->used_time)).'<br>';
    echo '值:'.$model->value.'<br>';
}
?>
    </div>