<?php
/**
 * @link http://www.yincart.com/
 * @copyright Copyright (c) 2014 Yincart
 * @license http://www.yincart.com/license/
 */

namespace kiwi\payment;


use kiwi\web\Controller;
use Yii;
use yii\helpers\ArrayHelper;

class PayController extends Controller
{
    public $enableCsrfValidation = false;

    public function actionCallback($method)
    {
        $request = Yii::$app->request;
        $data = ArrayHelper::merge($request->post(), $request->get());
        Yii::$app->payment->callback($method, $data);
        echo 'ok';
    }
} 