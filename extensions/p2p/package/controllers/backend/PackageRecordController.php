<?php

namespace p2p\package\controllers\backend;

use kiwi\helpers\ArrayHelper;
use kiwi\Kiwi;
use Yii;
use p2p\package\models\PackageRecord;
use p2p\package\searches\PackageRecordSearch;
use kiwi\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

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
