<?php
/**
 * Created by PhpStorm.
 * User: LCH
 * Date: 2015/7/18
 * Time: 14:28
 */

use yii\helpers\Url;

?>
<div class="containerMain">
    <ul class="clearFix rechargeTitle">
        <li><a href="<?= Url::to(['/withdraw/withdraw/withdraw']) ?>">提现申请</a></li>
        <li><a class="active" href="#">提现记录</a></li>
    </ul>
    <br>
    <?php
    /** @var \p2p\withdraw\models\WithdrawRecord $model */
    foreach ($models as $model) {
        echo '金额:' . $model->money . '<br>';
        echo '手续费:' . $model->counter_fee . '<br>';
        echo '提现时间:' . date('Y-m-d H:i:s', $model->create_time) . '<br>';
    }
    ?>
</div>