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
use yii\data\ActiveDataProvider;

class RechargeController extends Controller
{
    public $layout = '/account';

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

    public function actionSuccess()
    {
        return $this->render('success');
    }

    public function actionRechargeList()
    {
        $rechargeRecordClass = Kiwi::getRechargeRecordClass();

        $dataProvider = new ActiveDataProvider([
            'query' => $rechargeRecordClass::find()->andWhere([
                'member_id' => Yii::$app->user->id
            ]),
            'pagination' => [
                'pageSize' => 20,
            ],
        ]);

        $models = $dataProvider->getModels();

        return $this->render('recharge_list', [
            'models' => $models,
        ]);
    }
} 