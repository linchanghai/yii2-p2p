<?php

namespace p2p\withdraw\controllers\backend;

use Yii;
use p2p\withdraw\models\WithdrawRecord;
use p2p\withdraw\searches\WithdrawRecordSearch;
use kiwi\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * WithdrawRecordController implements the CRUD actions for WithdrawRecord model.
 */
class WithdrawRecordController extends Controller
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
     * Lists all WithdrawRecord models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new WithdrawRecordSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionAuto(){
        $searchModel = new WithdrawRecordSearch();
        $dataProvider = $searchModel->searchAUTO(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    public function actionPending(){
        $searchModel = new WithdrawRecordSearch();
        $dataProvider = $searchModel->searchPending(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    public function actionSuccess(){
        $searchModel = new WithdrawRecordSearch();
        $dataProvider = $searchModel->searchSuccess(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    public function actionFail(){
        $searchModel = new WithdrawRecordSearch();
        $dataProvider = $searchModel->searchFail(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    public function actionFirst(){
        $searchModel = new WithdrawRecordSearch();
        $dataProvider = $searchModel->searchFirst(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    /**
     * Finds the WithdrawRecord model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return WithdrawRecord the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = WithdrawRecord::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
