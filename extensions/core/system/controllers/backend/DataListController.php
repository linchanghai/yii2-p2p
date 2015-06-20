<?php

namespace core\system\controllers\backend;

use kiwi\Kiwi;
use Yii;
use kiwi\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * DataListController implements the CRUD actions for DataList model.
 */
class DataListController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all DataList models.
     * @param $type
     * @return mixed
     */
    public function actionIndex($type = '')
    {
        return $this->render('index', ['dataList' => Kiwi::getDataListModel(), 'type' => $type]);
    }

    /**
     * Creates a new DataList model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @param $type
     * @return mixed
     * @throws NotFoundHttpException if the type cannot be found
     */
    public function actionCreate($type)
    {
        $dataList = Kiwi::getDataListModel();
        if (!$dataList->hasDataList($type, true)) {
            throw new NotFoundHttpException('The requested page does not exist.');
        }

        $model = Kiwi::getDataList(['type' => $type]);

        if ($model->load(Yii::$app->request->post()) && $dataList->addValue($model)) {
            return $this->redirect(['index', 'type' => $type]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing DataList model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $dataList = Kiwi::getDataListModel();
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $dataList->updateValue($model)) {
            return $this->redirect(['index', 'type' => $model->type]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing DataList model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        Kiwi::getDataListModel()->removeValue($model);

        return $this->redirect(['index']);
    }

    /**
     * Finds the DataList model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return \core\system\models\DataList the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        $dataListClass = Kiwi::getDataListClass();
        if (($model = $dataListClass::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
