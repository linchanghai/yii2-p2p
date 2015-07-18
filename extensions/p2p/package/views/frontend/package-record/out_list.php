<?php
/**
 * Created by PhpStorm.
 * User: LCH
 * Date: 2015/7/18
 * Time: 15:19
 */

use yii\helpers\Url;

?>
<div class="containerMain">
    <ul class="clearFix rechargeTitle">
        <li><a href="<?= Url::to(['package-list'])?>">钱包管理</a></li>
        <li><a href="<?= Url::to(['into-list'])?>">转入记录</a></li>
        <li><a class="active" href="<?= Url::to(['out-list'])?>">转出记录</a></li>
    </ul>
    <br>
    <?php
    /** @var \p2p\package\models\PackageRecord $model */
    foreach ($models as $model) {
    }
    ?>
</div>