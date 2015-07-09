<?php
/**
 * @link http://www.yincart.com/
 * @copyright Copyright (c) 2014 Yincart
 * @license http://www.yincart.com/license/
 */

namespace p2p\withdraw\controllers\frontend;


use kiwi\Kiwi;
use kiwi\web\Controller;
use Yii;

class WithdrawController extends Controller
{
    public function actionWithdraw()
    {
        $withdrawForm = Kiwi::getWithdrawForm();
        if ($withdrawForm->load(Yii::$app->request->post())) {
            $withdrawForm->withdraw();
        }
        return $this->render('withdraw', ['model' => $withdrawForm]);
    }
} 