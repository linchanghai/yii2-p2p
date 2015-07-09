<?php

namespace p2p\withdraw\controllers\backend;

use kiwi\helpers\ArrayHelper;
use kiwi\Kiwi;
use Yii;
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
        $searchModel = Kiwi::getWithdrawRecordSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionAuto()
    {
        $withdrawClass = Kiwi::getWithdrawRecord();
        $searchModel = Kiwi::getWithdrawRecordSearch();
        $dataProvider = $searchModel->search(ArrayHelper::merge(Yii::$app->request->queryParams, [
            'WithdrawRecordSearch' => [
                'deposit_type' => $withdrawClass::TYPE_AUTO
            ]
        ]));

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionPending()
    {
        $withdrawClass = Kiwi::getWithdrawRecord();
        $searchModel = Kiwi::getWithdrawRecordSearch();
        $dataProvider = $searchModel->search(ArrayHelper::merge(Yii::$app->request->queryParams, [
            'WithdrawRecordSearch' => [
                'deposit_type' => $withdrawClass::TYPE_MANUAL,
                'status' => $withdrawClass::STATUS_PENDING
            ]
        ]));

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionSuccess()
    {
        $withdrawClass = Kiwi::getWithdrawRecord();
        $searchModel = Kiwi::getWithdrawRecordSearch();
        $dataProvider = $searchModel->search(ArrayHelper::merge(Yii::$app->request->queryParams, [
            'WithdrawRecordSearch' => [
                'deposit_type' => $withdrawClass::TYPE_MANUAL,
                'status' => $withdrawClass::STATUS_SUCCESS
            ]
        ]));

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionFail()
    {
        $withdrawClass = Kiwi::getWithdrawRecord();
        $searchModel = Kiwi::getWithdrawRecordSearch();
        $dataProvider = $searchModel->search(ArrayHelper::merge(Yii::$app->request->queryParams, [
            'WithdrawRecordSearch' => [
                'deposit_type' => $withdrawClass::TYPE_MANUAL,
                'status' => $withdrawClass::STATUS_FAIL
            ]
        ]));

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionFirst()
    {
        $withdrawClass = Kiwi::getWithdrawRecord();
        $searchModel = Kiwi::getWithdrawRecordSearch();
        $dataProvider = $searchModel->search(ArrayHelper::merge(Yii::$app->request->queryParams, [
            'WithdrawRecordSearch' => [
                'deposit_type' => $withdrawClass::TYPE_MANUAL,
                'status' => $withdrawClass::STATUS_FIRST_VERIFY_SUCCESS
            ]
        ]));

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
        $withdrawRecord = Kiwi::getWithdrawRecord();
        if (($model = $withdrawRecord::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
