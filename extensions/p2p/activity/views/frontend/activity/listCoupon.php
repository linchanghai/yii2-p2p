<?php
list($path, $link) = $this->getAssetManager()->publish('@p2p/activity/web/js');
$this->registerJsFile($link . '/exchange.js', ['depends' => [\yii\web\JqueryAsset::className()]]);

foreach($ProductMap as $coupon){
?>

    <?= $coupon->type?>//
    <?= $coupon->exchange_points?>
    <br/>
    <?= \yii\helpers\Html::button('duihuan',[
        'data-id'=>$coupon->product_map_id,
        'class'=>'exchange-coupon',
        'data-url'=>\yii\helpers\Url::to(['/activity/activity/coupon-exchange'])
    ])?>
<?php } ?>