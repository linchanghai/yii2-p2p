<?php
/**
 * Created by PhpStorm.
 * Author: changhai.lin<1079140464@qq.com>
 * Date: 2015/7/31
 * Time: 11:06
 */

namespace p2p\transfer\controllers\frontend;


use kiwi\Kiwi;
use kiwi\web\Controller;

class TransferController extends Controller
{
    public $layout = '/account';

    public function actionEnable()
    {
        $searchModel = Kiwi::getProjectInvestSearch();
        $dataProvider = $searchModel->frontendSearch(\Yii::$app->request->queryParams);

        $dataProvider->prepare(true);

        return $this->render('enableTransfer', [
            'projectInvests' => $dataProvider->models,
            'pages' => $dataProvider->pagination,
        ]);
    }

    public function actionPending()
    {
        $searchModel = Kiwi::getProjectInvestSearch();
        $dataProvider = $searchModel->frontendSearch(\Yii::$app->request->queryParams);

        $dataProvider->prepare(true);

        return $this->render('pendingTransfer', [
            'projectInvests' => $dataProvider->models,
            'pages' => $dataProvider->pagination,
        ]);
    }

    public function actionCompleted()
    {
        $searchModel = Kiwi::getProjectInvestSearch();
        $dataProvider = $searchModel->frontendSearch(\Yii::$app->request->queryParams);

        $dataProvider->prepare(true);

        return $this->render('completedTransfer', [
            'projectInvests' => $dataProvider->models,
            'pages' => $dataProvider->pagination,
        ]);
    }

    public function actionCreate($project_invest_id)
    {
        $transferForm = Kiwi::getTransferForm([
            'project_invest_id' => $project_invest_id,
        ]);

        if ($transferForm->load(\Yii::$app->request->post())) {
            $transferForm->createTransfer();
        }

        return $this->render('transfer', [
            'invest' => $transferForm->invest,
            'transferForm' => $transferForm,
        ]);
    }
}