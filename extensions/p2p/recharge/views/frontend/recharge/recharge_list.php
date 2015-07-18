<?php
/**
 * Created by PhpStorm.
 * User: LCH
 * Date: 2015/7/18
 * Time: 14:04
 */

use yii\helpers\Url;

?>
<div class="containerMain">
    <ul class="clearFix rechargeTitle">
        <li><a class="active" href="#">充值记录</a></li>
    </ul>
    <br>
    <?php
    /** @var \p2p\recharge\models\RechargeRecord $model */
    foreach ($models as $model) {
        echo '金额:' . $model->money . '<br>';
        echo '充值时间:' . date('Y-m-d H:i:s', $model->create_time) . '<br>';
    }
    ?>
</div>