<?php
/**
 * @link http://www.yincart.com/
 * @copyright Copyright (c) 2014 Yincart
 * @license http://www.yincart.com/license/
 */

namespace p2p\withdraw\controllers\frontend;

use kiwi\Kiwi;
use kiwi\web\Controller;
use Yii;
use yii\data\ActiveDataProvider;

class WithdrawController extends Controller
{
    public $layout = '/account';

    public function actionWithdraw()
    {
        $withdrawForm = Kiwi::getWithdrawForm();
        if ($withdrawForm->load(Yii::$app->request->post())) {
            $withdrawForm->withdraw();
        }
        return $this->render('withdraw', [
            'model' => $withdrawForm
        ]);
    }

    public function actionWithdrawList()
    {
        $withdrawRecordClass = Kiwi::getWithdrawRecordClass();

        $dataProvider = new ActiveDataProvider([
            'query' => $withdrawRecordClass::find()->andWhere([
                'member_id' => Yii::$app->user->id
            ]),
            'pagination' => [
                'pageSize' => 20,
            ],
        ]);

        $models = $dataProvider->getModels();

        return $this->render('withdraw_list', [
            'models' => $models,
        ]);
    }
} 