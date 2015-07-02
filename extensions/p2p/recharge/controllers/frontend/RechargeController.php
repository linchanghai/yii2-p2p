<?php
/**
 * @link http://www.yincart.com/
 * @copyright Copyright (c) 2014 Yincart
 * @license http://www.yincart.com/license/
 */

namespace p2p\recharge\controllers\frontend;


use kiwi\Kiwi;
use kiwi\web\Controller;
use Yii;

class RechargeController extends Controller
{
    public function actionRecharge()
    {
        $rechargeForm = Kiwi::getRechargeForm();
        if ($rechargeForm->load(Yii::$app->request->post())) {
            $rechargeForm->pay();
        }
        return $this->render('recharge', ['model' => $rechargeForm]);
    }
} 