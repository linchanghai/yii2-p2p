<?php
/**
 * @link http://www.yincart.com/
 * @copyright Copyright (c) 2014 Yincart
 * @license http://www.yincart.com/license/
 */

use kiwi\Kiwi;
use yii\widgets\ActiveForm;
use yii\helpers\Html;

/** @var \p2p\recharge\forms\RechargeForm $model */

$form = ActiveForm::begin();

echo $form->field($model, 'money');
echo $form->field($model, 'method')->dropDownList(Kiwi::getDataListModel()->rechargeMethods);

echo Html::submitButton('确认支付');

$form->end();
