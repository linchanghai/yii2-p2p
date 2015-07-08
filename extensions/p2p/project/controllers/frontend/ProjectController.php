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
use yii\data\ActiveDataProvider;
use yii\web\NotFoundHttpException;

class ProjectController extends Controller
{
    public function actionList()
    {
        $projectClass = Kiwi::getProjectClass();

        $dataProvider = new ActiveDataProvider([
            'query' => $projectClass::find()->where([
                'status' => $projectClass::STATUS_INVESTING,
            ]),
        ]);

        $dataProvider->prepare(true);

        return $this->render('list', [
            'projects' => $dataProvider->models,
        ]);
    }

    public function actionDetails()
    {
        $project_id = \Yii::$app->request->get('project_id');

        return $this->render('details', [
            'project' => $this->findModel($project_id)
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