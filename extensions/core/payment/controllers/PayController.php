<?php
/**
 * @author Lujie.Zhou(lujie.zhou@jago-ag.cn) 
 * @Date 12/17/2014
 * @Time 2:48 PM
 */

namespace core\payment\controllers;

use kiwi\Kiwi;
use kiwi\web\Controller;

class PayController extends Controller
{
    public function actionNotice($method)
    {
        $onlinePay = Kiwi::getOnlinePay()->instance($method);
        $onlinePay->notify(\Yii::$app->request->post());
    }

    public function actionReturn($method)
    {
        echo $method . 'return';
    }
} 