<?php
/**
 * @link http://www.yincart.com/
 * @copyright Copyright (c) 2014 Yincart
 * @license http://www.yincart.com/license/
 */

use kiwi\Kiwi;
use yii\widgets\ActiveForm;
use yii\helpers\Html;
use yii\helpers\Url;

/** @var \p2p\withdraw\forms\WithdrawForm $model */

$form = ActiveForm::begin();

$memberStatistic = Kiwi::getMemberStatistic();
/** @var \core\member\models\MemberStatistic $memberStatistic */
$memberStatistic = $memberStatistic::findOne(['member_id' => Yii::$app->user->id]);

?>
<div class="containerMain">
    <ul class="clearFix rechargeTitle">
        <li><a class="active" href="#">提现申请</a></li>
        <li><a href="<?= Url::to(['/withdraw/withdraw/withdraw-list']) ?>">提现记录</a></li>
    </ul>
    <br>
    <?php
    echo $form->field($model, 'withdrawMoney');
    echo $form->field($model, 'canWithdrawMoney')->textInput(['value' => $memberStatistic->account_money, 'readonly' => true]);
    echo $form->field($model, 'withdrawFee')->textInput(['value' => 10]);

    echo Html::submitButton('申请提现');

    $form->end();
    ?>
</div>
