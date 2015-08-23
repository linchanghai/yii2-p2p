<?php

namespace p2p\package\controllers\backend;

use kiwi\Kiwi;
use Yii;
use kiwi\web\Controller;

/**
 * PackageInterestRecordController implements the CRUD actions for PackageInterestRecord model.
 */
class PackageInterestRecordController extends Controller
{
    /**
     * Lists all PackageInterestRecord models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = Kiwi::getPackageInterestRecordSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }


}
