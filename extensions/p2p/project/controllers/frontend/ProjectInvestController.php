<?php


namespace p2p\project\controllers\frontend;

use Yii;
use kiwi\Kiwi;
use kiwi\web\Controller;

class ProjectInvestController extends Controller
{
    public function actionInterestTable($project_id, $invest_money, $annual_id = null) {
        $InvestPrepareForm = Kiwi::getProjectInvestPrepareForm([
            'project_id' => $project_id,
            'money' => $invest_money,
            'annual_id' => $annual_id
        ]);
        return $this->renderPartial('interest_table', [
            'invest' => $InvestPrepareForm->getInvestInfo()
        ]);
    }

    public function actionPrepareInvest($id)
    {
        $InvestPrepareForm = Kiwi::getProjectInvestPrepareForm(['project_id' => $id]);
        if ($InvestPrepareForm->load(Yii::$app->request->post())) {
            $this->render('prepare', [
                'InvestPrepareForm' => $InvestPrepareForm->getInvestInfo(),
            ]);
        } else {
            return $this->render('prepare', [
                'InvestPrepareForm' => $InvestPrepareForm->getInvestInfo(),
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