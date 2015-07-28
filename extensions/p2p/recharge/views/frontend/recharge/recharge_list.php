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
        <li><a href="<?= Url::to(['/recharge/recharge/recharge']) ?>">网银支付</a></li>
        <li><a class="active" href="#">充值记录</a></li>
    </ul>
    <div class="myWalletAreaDetail backGrey">
        <div class="myWalletSingle p20">
            <table class="table table-bordered textCenter">
                <thead>
                <tr>
                    <th>时间</th>
                    <th>金额(元)</th>
                </tr>
                </thead>
                <tbody>
                <?php
                /** @var \p2p\recharge\models\RechargeRecord $model */
                foreach ($models as $model) {
                    echo '<tr>';
                    echo '<td>' . date('Y-m-d H:i:s', $model->create_time) . '</td>';
                    echo '<td>' . $model->money . '</td>';
                    echo '</tr>';
                }
                ?>
                </tbody>
            </table>
        </div>
    </div>
</div>