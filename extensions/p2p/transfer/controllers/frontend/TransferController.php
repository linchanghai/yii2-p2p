<?php
/**
 * Created by PhpStorm.
 * Author: changhai.lin<1079140464@qq.com>
 * Date: 2015/7/31
 * Time: 11:06
 */

namespace p2p\transfer\controllers\frontend;

use kiwi\helpers\ArrayHelper;
use kiwi\Kiwi;
use kiwi\web\Controller;
use Yii;

class TransferController extends Controller
{
    public $layout = '/account';

    public function actionEnable()
    {
        $searchModel = Kiwi::getProjectInvestSearch();
        $dataProvider = $searchModel->enableTransferSearch(Yii::$app->request->queryParams);

        $dataProvider->prepare(true);

        return $this->render('enableTransfer', [
            'models' => $dataProvider->models,
            'pagination' => $dataProvider->pagination,
        ]);
    }

    public function actionPending()
    {
        $projectInvestTransferApplyClass = Kiwi::getProjectInvestTransferApplyClass();
        $searchModel = Kiwi::getProjectInvestTransferApplySearch();
        $dataProvider = $searchModel->frontendSearch(ArrayHelper::merge(Yii::$app->request->queryParams, [
            'ProjectInvestTransferApplySearch' => [
                'status' => $projectInvestTransferApplyClass::STATUS_PENDING
            ]
        ]));

        $dataProvider->prepare(true);

        return $this->render('pendingTransfer', [
            'models' => $dataProvider->models,
            'pagination' => $dataProvider->pagination,
        ]);
    }

    public function actionCompleted()
    {
        $projectInvestTransferApplyClass = Kiwi::getProjectInvestTransferApplyClass();
        $searchModel = Kiwi::getProjectInvestTransferApplySearch();
        $dataProvider = $searchModel->frontendSearch(ArrayHelper::merge(Yii::$app->request->queryParams, [
            'ProjectInvestTransferApplySearch' => [
                'status' => $projectInvestTransferApplyClass::STATUS_END
            ]
        ]));

        $dataProvider->prepare(true);

        return $this->render('completedTransfer', [
            'models' => $dataProvider->models,
            'pagination' => $dataProvider->pagination,
        ]);
    }

    public function actionCreate($project_invest_id)
    {
        $transferForm = Kiwi::getTransferForm([
            'project_invest_id' => $project_invest_id,
        ]);

        if ($transferForm->load(Yii::$app->request->post())) {
            $transferForm->createTransfer();
        }

        return $this->render('transfer', [
            'invest' => $transferForm->invest,
            'transferForm' => $transferForm,
        ]);
    }
}