<?php
/**
 * @link http://www.yincart.com/
 * @copyright Copyright (c) 2014 Yincart
 * @license http://www.yincart.com/license/
 */

use kiwi\Kiwi;
use yii\widgets\ActiveForm;
use yii\helpers\Html;

/** @var \p2p\withdraw\forms\WithdrawForm $model */

$form = ActiveForm::begin();

echo $form->field($model, 'withdrawMoney');
echo $form->field($model, 'canWithdrawMoney');
echo $form->field($model, 'withdrawFee')->textInput(['value' => 10]);

echo Html::submitButton('申请提现');

$form->end();
