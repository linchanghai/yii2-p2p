<?php
/**
 * @author Lujie.Zhou(lujie.zhou@jago-ag.cn)
 * @Date 6/17/2015
 * @Time 9:29 PM
 */

use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this yii\web\View */
/** @var array $data */

/** @var \kiwi\payment\BasePayment $onlinePay */
$onlinePay = $this->context;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>请不要关闭页面,支付跳转中.....</title>
</head>
<body>
<form action="<?= Url::to($onlinePay->requestUrl, true) ?>" name="pay" id="pay" method="POST">
<?php foreach ($data as $key => $value) {
    echo Html::hiddenInput($key, $value);
}
?>
</form>
<script type="text/javascript">
    document.getElementById("pay").submit();
</script>
</body>
</html>