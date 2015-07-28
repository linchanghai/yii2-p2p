<?php
/**
 * Created by PhpStorm.
 * User: LCH
 * Date: 2015/7/18
 * Time: 16:06
 */

use yii\helpers\Url;

?>
<div class="containerMain fundsFlow">
    <div class="itemTitle">
        资金流水记录
    </div>
    <div class="fundsFlowContent p20">
        <div class="clearFix mt10 filterLine">
            <label>时间范围:</label>
            <a class="active" href="#">全部</a>
            <a href="#">1个月</a>
            <a href="#">2个月</a>
            <a href="#">3个月</a>
            <span class="fl">从</span>
            <input type="text" placeholder="请选择开始时间" class="fl datePicker">
            <span class="fl">到</span>
            <input type="text" placeholder="请选择截止时间" class="fl datePicker">
        </div>
        <div class="clearFix mt10 filterLine">
            <label>项目收益:</label>
            <a class="active" href="#">全部</a>
            <a href="#">充值</a>
            <a href="#">提现</a>
            <a href="#">投资</a>
            <a href="#">回收</a>
            <a href="#">转让债券</a>
        </div>
        <table class="table table-bordered textCenter mt20">
            <thead>
            <tr>
                <th>交易时间</th>
                <th>交易类型</th>
                <th>交易金额(元)</th>
                <th>账户金额(元)</th>
                <th>备注</th>
            </tr>
            </thead>
            <tbody>
            <?php
            if (isset($models) && $models) {
                /** @var \core\member\models\StatisticChangeRecord $model */
                foreach ($models as $model) {
                    echo '<tr>';
                    echo '<td>' . date('Y-m-d H:i:s', $model->create_time) . '</td>';
                    echo '<td>' . $model->type . '</td>';
                    echo '<td>' . $model->value . '</td>';
                    echo '<td>' . $model->result . '</td>';
                    echo '<td>' . $model->note . '</td>';
                    echo '</tr>';
                }
            } else {
                ?>
                <tr>
                    <td colspan=5>
                        <div class="tableNoInfo">
                            <i class="glyphicon glyphicon-info-sign secondColor"></i> 暂无数据
                            <p>
                                <a href="#" class="mt20 btn regularBtn">立即充值</a>
                            </p>
                        </div>
                    </td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
    </div>
</div>