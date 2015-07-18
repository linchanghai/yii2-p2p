<?php
/**
 * Created by PhpStorm.
 * User: LCH
 * Date: 2015/7/18
 * Time: 16:06
 */

use yii\helpers\Url;

?>
<div class="containerMain">
    <ul class="clearFix rechargeTitle">
        <li><a class="active" href="<?= Url::to(['statistic-list'])?>">资金流水记录</a></li>
    </ul>
    <br>
    <?php
    /** @var \core\member\models\StatisticChangeRecord $model */
    foreach ($models as $model) {
//        echo '类型:' . $model->type . '<br>';
//        echo '时间:' . date('Y-m-d H:i:s', $model->create_time) . '<br>';
    }
    ?>
</div>