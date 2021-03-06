<?php
/**
 * Created by PhpStorm.
 * User: LCH
 * Date: 2015/6/29
 * Time: 9:26
 */

namespace p2p\project\controllers\frontend;

use kiwi\Kiwi;
use kiwi\web\Controller;
use Yii;
use yii\web\NotFoundHttpException;

class ProjectController extends Controller
{
    public function actionList()
    {
        $searchModel = Kiwi::getProjectSearch();
        $dataProvider = $searchModel->frontendSearch(Yii::$app->request->queryParams);

        $dataProvider->prepare(true);

        return $this->render('list', [
            'models' => $dataProvider->models,
            'pages' =>$dataProvider->pagination,
        ]);
    }

    public function actionDetails($id)
    {
        $project = $this->findModel($id);
        $investForm = Kiwi::getInvestForm(['project_id' => $id]);
        if ($investForm->load(Yii::$app->request->post()) && $investForm->invest()) {
            return $this->redirect(['success', 'id' => $investForm->invest->project_invest_id]);
        }

        return $this->render('details', [
            'project' => $project,
            'investForm' => $investForm,
        ]);
    }

    public function actionInterestInfo($project_id) {
        $investForm = Kiwi::getInvestForm(['project_id' => $project_id]);
        $investForm->load(Yii::$app->request->get(), '');
        $investForm->validate();

        return $this->renderPartial('interestInfo', [
            'invest' => $investForm->getInvest()
        ]);
    }

    /**
     * Finds the Project model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Project the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        $projectClass = Kiwi::getProjectClass();
        if (($model = $projectClass::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionSuccess($id){
        $invest = Kiwi::getProjectInvest()->findOne($id);
        if (!$invest) {
            throw new NotFoundHttpException('The requested page does not exist.');
        }

        return $this->render('success',[
            'projectModel'=> $invest,
        ]);
    }
}