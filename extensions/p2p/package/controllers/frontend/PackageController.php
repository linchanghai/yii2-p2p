<?php
/**
 * @link http://www.yincart.com/
 * @copyright Copyright (c) 2014 Yincart
 * @license http://www.yincart.com/license/
 */

namespace p2p\package\controllers\frontend;


use kiwi\Kiwi;
use kiwi\web\Controller;
use Yii;
use yii\data\ActiveDataProvider;
use yii\helpers\Json;

class PackageController extends Controller
{
    public $layout = '/account';

    public function actionIndex()
    {
        $packageRecordClass = Kiwi::getPackageRecordClass();
        $intoDataProvider = new ActiveDataProvider([
            'query' => $packageRecordClass::find()->andWhere(['type' => $packageRecordClass::TYPE_INTO]),
        ]);
        $outDataProvider = new ActiveDataProvider([
            'query' => $packageRecordClass::find()->andWhere(['type' => $packageRecordClass::TYPE_OUT]),
        ]);
        return $this->render('index', [
            'intoDataProvider' => $intoDataProvider,
            'outDataProvider' => $outDataProvider,
        ]);
    }

    public function actionAuto()
    {
        $isAuto = Yii::$app->request->post('isAuto');
        $memberStatistic = Yii::$app->user->identity->memberStatistic;
        $memberStatistic->is_auto_into = $isAuto ? 1 : 0;
        return Json::encode(['status' => $memberStatistic->save()]);
    }

    public function actionInto()
    {
        $intoPackageForm = Kiwi::getIntoPackageForm();
        if ($intoPackageForm->load(Yii::$app->request->post()) && $intoPackageForm->intoPackage()) {
            $this->redirect(['index']);
        }
        return $this->render('into', ['model' => $intoPackageForm]);
    }

    public function actionOut()
    {
        $outPackageForm = Kiwi::getOutPackageForm();
        return $this->render('out', ['model' => $outPackageForm]);
    }
} 