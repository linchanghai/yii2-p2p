<?php


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
            $this->render('prepare', [
                'InvestPrepareForm' => $InvestPrepareForm->getInvestInfo(),
            ]);
        } else {
            return $this->render('create', [
                'InvestPrepareForm' => $InvestPrepareForm,
            ]);
        }
    }

    public function actionConfirmInvest()
    {
        $InvestPrepareForm = Kiwi::getProjectInvestPrepareForm();
        if ($InvestPrepareForm->load(Yii::$app->request->post())) {
            $this->render('confirm', [
                'InvestPrepareForm' => $InvestPrepareForm->getInvestInfo(),
            ]);
        } else {
            return $this->render('create', [
                'InvestPrepareForm' => $InvestPrepareForm,
            ]);
        }
    }

    public function actionSaveInvest()
    {
        $InvestPrepareForm = Kiwi::getProjectInvestPrepareForm();
        if ($InvestPrepareForm->load(Yii::$app->request->post())) {
            $this->render('confirm', [
                'InvestPrepareForm' => $InvestPrepareForm->saveInvest(),
            ]);
        } else {
            return $this->render('create', [
                'InvestPrepareForm' => $InvestPrepareForm,
            ]);
        }
    }

    public function actionInvest()
    {
        $InvestForm = Kiwi::getProjectInvestForm();
        if ($InvestForm->load(Yii::$app->request->post())) {
            $InvestForm->payInvest();
        }
    }
} 