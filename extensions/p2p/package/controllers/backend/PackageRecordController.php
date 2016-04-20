<?php

namespace p2p\package\controllers\backend;

use kiwi\helpers\ArrayHelper;
use kiwi\Kiwi;
use Yii;
use kiwi\web\Controller;

/**
 * PackageRecordController implements the CRUD actions for PackageRecord model.
 */
class PackageRecordController extends Controller
{
    /**
     * Lists all PackageRecord models.
     * @return mixed
     */
    public function actionIntoIndex()
    {
        $packageRecordClass = Kiwi::getPackageRecordClass();
        $searchModel = Kiwi::getPackageRecordSearch();
        $dataProvider = $searchModel->search(ArrayHelper::merge(Yii::$app->request->queryParams, [
            'PackageRecordSearch' => [
                'status' => $packageRecordClass::TYPE_INTO,
            ]]));

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'title' => Yii::t('p2p_package', 'Package Into Records')
        ]);
    }

    public function actionOutIndex()
    {
        $packageRecordClass = Kiwi::getPackageRecordClass();
        $searchModel = Kiwi::getPackageRecordSearch();
        $dataProvider = $searchModel->search(ArrayHelper::merge(Yii::$app->request->queryParams, [
            'PackageRecordSearch' => [
                'status' => $packageRecordClass::TYPE_OUT,
            ]]));

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'title' => Yii::t('p2p_package', 'Package Out Records')
        ]);
    }

}
