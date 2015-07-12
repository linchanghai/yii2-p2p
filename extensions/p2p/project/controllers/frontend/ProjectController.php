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
        $dataProvider = $searchModel->frontendSearch(\Yii::$app->request->queryParams);

        $dataProvider->prepare(true);

        return $this->render('list', [
            'projects' => $dataProvider->models,
            'pages' =>$dataProvider->pagination,
        ]);
    }

    public function actionDetails($id)
    {
        $project = $this->findModel($id);
        $investForm = Kiwi::getInvestForm();
        if ($investForm->load(Yii::$app->request->post()) && $investForm->invest()) {
            $this->redirect(['details', ['project_id' => $project]]);
        }

        return $this->render('details', [
            'project' => $project,
            'investForm' => $investForm,
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
}