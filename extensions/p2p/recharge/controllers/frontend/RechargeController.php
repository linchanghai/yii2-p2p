<?php
/**
 * @link http://www.yincart.com/
 * @copyright Copyright (c) 2014 Yincart
 * @license http://www.yincart.com/license/
 */

namespace p2p\recharge\controllers\frontend;

use kiwi\Kiwi;
use kiwi\web\Controller;
use Yii;
use yii\web\NotFoundHttpException;

class RechargeController extends Controller
{
    public $layout='/account';

    public function actionRecharge()
    {
        $rechargeForm = Kiwi::getRechargeForm();
        if ($rechargeForm->load(Yii::$app->request->post())) {
            $rechargeForm->pay();
        }
        return $this->render('recharge', [
            'model' => $rechargeForm
        ]);
    }

    public function actionSuccess($id) {
        $rechargeRecord = Kiwi::getRechargeRecord()->findOne(['transaction_id' => $id]);
        if (!$rechargeRecord) {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
        return $this->render('success', ['model' => $rechargeRecord]);
    }

    public function actionRechargeList()
    {
        $searchModel = Kiwi::getRechargeRecordSearch();
        $dataProvider = $searchModel->frontendSearch(Yii::$app->request->queryParams);

        $models = $dataProvider->getModels();

        return $this->render('recharge_list', [
            'models' => $models,
        ]);
    }
} 