<?php


namespace p2p\project\controllers\frontend;

use Yii;
use kiwi\Kiwi;
use kiwi\web\Controller;
use yii\data\ActiveDataProvider;

class ProjectInvestController extends Controller
{
    public function actionInterestTable($project_id, $invest_money, $annual_id = null)
    {
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


    public function actionGridView()
    {
        $this->layout = '/account';
        $projectInvest = Kiwi::getProjectInvest();
        $query = $projectInvest::find()->andWhere(['member_id' => Yii::$app->user->id]);
        if (Yii::$app->request->isGet) {
            switch (Yii::$app->request->get('status')) {
                case $projectInvest::STATUS_REPAYMENT:
                    $query = $query->andWhere(['status' => $projectInvest::STATUS_REPAYMENT]);
                    break;
                case $projectInvest::STATUS_FINISHED:
                    $query = $query->andWhere(['status' => $projectInvest::STATUS_FINISHED]);
                    break;
            }
        }
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 20,
            ],
        ]);
        $models = $dataProvider->getModels();
        return $this->render('gridView', [
            'models' => $models,
            'pagination' => $dataProvider->pagination,
        ]);
    }

    public function actionRepaymentList($invest_id)
    {
        $projectRepayment = Kiwi::getProjectRepayment();
        $models = $projectRepayment::find()->andWhere([
            'member_id' => Yii::$app->user->id,
            'project_invest_id' => $invest_id
        ])->all();
        return $this->renderPartial('paymentList', [
            'models' => $models,
        ]);
    }
} 