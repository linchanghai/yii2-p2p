<?php

namespace p2p\project\controllers\backend;

use kiwi\helpers\ArrayHelper;
use kiwi\Kiwi;
use Yii;

/**
 * ProjectController implements the CRUD actions for Project model.
 */
class ProjectEndController extends ProjectController
{
    /**
     * Lists all Project models.
     * @return mixed
     */
    public function actionIndex()
    {
        $projectClass = Kiwi::getProjectClass();
        $searchModel = Kiwi::getProjectSearch();
        $dataProvider = $searchModel->search(ArrayHelper::merge(Yii::$app->request->queryParams, [
            'ProjectSearch' => [
                'status' => $projectClass::STATUS_END,
                'id_delete' => 0,
            ]]));

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'status' => $projectClass::STATUS_END,
        ]);
    }
}
