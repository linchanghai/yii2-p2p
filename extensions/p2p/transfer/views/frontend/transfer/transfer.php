<?php
/**
 * Created by PhpStorm.
 * Author: changhai.lin<1079140464@qq.com>
 * Date: 2015/8/3
 * Time: 10:43
 */

use kiwi\Kiwi;
use yii\widgets\ActiveForm;
use yii\helpers\Html;
use yii\helpers\Url;

/** @var \p2p\transfer\forms\TransferForm $transferForm */
/** @var \p2p\project\models\ProjectInvest $invest */

$form = ActiveForm::begin();

?>
<div class="containerMain">
    <ul class="clearFix rechargeTitle">
        <li><a class="active" href="#">申请债券转让</a></li>
    </ul>
    <br>
    <input type="hidden" name="TransferForm[project_invest_id]" value="<?= $transferForm->project_invest_id?>">
    <?php
    echo $form->field($transferForm, 'min_money')->textInput();
    echo $form->field($transferForm, 'transfer_money')->textInput();
    echo $form->field($transferForm, 'discount_rate')->textInput();
    echo $form->field($transferForm, 'counter_fee')->textInput(['value' => 10, 'readonly' => true]);

    echo Html::submitButton('申请转让');

    $form->end();
    ?>
</div>