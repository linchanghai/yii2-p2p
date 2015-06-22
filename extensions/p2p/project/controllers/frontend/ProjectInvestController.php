<?php
/**
 * @link http://www.yincart.com/
 * @copyright Copyright (c) 2014 Yincart
 * @license http://www.yincart.com/license/
 */

namespace p2p\project\controllers\frontend;

use Yii;
use kiwi\Kiwi;
use kiwi\web\Controller;

class ProjectInvestController extends Controller
{
    public function actionPrepareInvest()
    {
        $InvestPrepareForm = Kiwi::getProjectInvestPrepareForm();
        if ($InvestPrepareForm->load(Yii::$app->request->post())) {
            return json_encode($InvestPrepareForm->calculateInvest());
        } else {
            return $this->render('create', [
                'InvestPrepareForm' => $InvestPrepareForm,
            ]);
        }
    }
} 