<?php
list($path, $link) = $this->getAssetManager()->publish('@p2p/activity/web/js');
$this->registerJsFile($link . '/exchange.js', ['depends' => [\yii\web\JqueryAsset::className()]]);

//\yii\widgets\Pjax::begin(['formSelector' => 'form']);
foreach($ProductMap as $coupon){
?>

    <?= $coupon->type?>//
    <?= $coupon->exchange_points?>
    <br/>
    <?php $form = \yii\widgets\ActiveForm::begin([
            'method' => 'post',
          'action' => \yii\helpers\Url::to(['/activity/activity/coupon-exchange']),
    ]) ?>
    <?= \yii\helpers\Html::hiddenInput('id', $coupon->product_map_id); ?>
    <?= \yii\helpers\Html::submitButton('duihuan')?>
    <?php $form::end() ?>
<?php }

//\yii\widgets\Pjax::end()
?>