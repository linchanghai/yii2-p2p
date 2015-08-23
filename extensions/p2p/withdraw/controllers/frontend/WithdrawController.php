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

class WithdrawController extends Controller
{
    public $layout = '/account';

    public function actionWithdraw()
    {
        $withdrawForm = Kiwi::getWithdrawForm();
        if ($withdrawForm->load(Yii::$app->request->post())) {
            $withdrawForm->withdraw();
        }

        $memberStatistic = Kiwi::getMemberStatistic();
        /** @var \core\member\models\MemberStatistic $memberStatistic */
        $memberStatistic = $memberStatistic::findOne(['member_id' => Yii::$app->user->id]);

        return $this->render('withdraw', [
            'memberStatistic' => $memberStatistic,
            'model' => $withdrawForm
        ]);
    }

    public function actionWithdrawList()
    {
        $searchModel = Kiwi::getWithdrawRecordSearch();
        $dataProvider = $searchModel->frontendSearch(Yii::$app->request->queryParams);

        $models = $dataProvider->getModels();

        return $this->render('withdraw_list', [
            'models' => $models,
            'pagination' => $dataProvider->pagination
        ]);
    }
} 