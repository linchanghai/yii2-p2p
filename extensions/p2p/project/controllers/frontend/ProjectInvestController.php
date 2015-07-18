<?php


namespace p2p\project\controllers\frontend;

use p2p\project\models\ProjectInvest;
use Yii;
use kiwi\Kiwi;
use kiwi\web\Controller;
use yii\data\ActiveDataProvider;

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


    public function actionGridView(){
        $this->layout = '/account';
        $dataProvider = new ActiveDataProvider([
            'query' => ProjectInvest::find()->andWhere(['member_id'=>Yii::$app->user->id]),
            'pagination' => [
                'pageSize' => 20,
            ],
        ]);
        $models = $dataProvider->getModels();
        return $this->render('gridView', [
            'models' => $models,
        ]);
    }
} 