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
    public function getViewPath()
    {
        return $this->module->getViewPath() . DIRECTORY_SEPARATOR . 'withdraw-record';
    }

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
        $withdrawClass = Kiwi::getWithdrawRecordClass();
        $searchModel = Kiwi::getWithdrawRecordSearch();
        $dataProvider = $searchModel->search(ArrayHelper::merge(Yii::$app->request->queryParams, [
            'WithdrawRecordSearch' => [
                'deposit_type' => $withdrawClass::TYPE_MANUAL,
                'status' => $withdrawClass::STATUS_PENDING
            ]]));

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'status' => $withdrawClass::STATUS_PENDING
        ]);
    }

    public function actionUpdate($id)
    {
        /** @var \p2p\withdraw\models\WithdrawRecord $model */
        $model = $this->findModel($id);

        $withdrawClass = Kiwi::getWithdrawRecordClass();
        if($model->status == $withdrawClass::STATUS_PENDING) {
            $model->scenario = 'firstVerify';
        } else {
            $model->scenario = 'secondVerify';
        }
        if ($model->load(Yii::$app->request->post())) {
            if (isset($model->second_verify_memo) && $model->second_verify_memo) {
                $model->second_verify_user = Yii::$app->user->id;
                $model->second_verify_date = time();
            } else if (isset($model->first_verify_memo) && $model->first_verify_memo) {
                $model->first_verify_user = Yii::$app->user->id;
                $model->first_verify_date = time();
                $model->status = $withdrawClass::STATUS_FIRST_VERIFY_SUCCESS;
            }
            $model->update();
            return $this->redirect('index');
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
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
