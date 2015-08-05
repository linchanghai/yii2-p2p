<?php
/**
 * Created by PhpStorm.
 * Author: changhai.lin<1079140464@qq.com>
 * Date: 2015/8/5
 * Time: 10:05
 */

namespace p2p\transfer\controllers\backend;

use kiwi\helpers\ArrayHelper;
use Yii;
use kiwi\Kiwi;

class TransferFailedController extends TransferController {
    /**
     * Lists all ProjectInvestTransferApply models.
     * @return mixed
     */
    public function actionIndex()
    {
        $transferClass = Kiwi::getProjectInvestTransferApplyClass();
        $searchModel = Kiwi::getProjectInvestTransferApplySearch();
        $dataProvider = $searchModel->search(ArrayHelper::merge(Yii::$app->request->queryParams, [
            'ProjectInvestTransferApplySearch' => [
                'status' => $transferClass::STATUS_FAILED,
            ]]));

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'status' => $transferClass::STATUS_FAILED,
        ]);
    }
}