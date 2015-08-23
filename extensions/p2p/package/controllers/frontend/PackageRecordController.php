<?php
/**
 * Created by PhpStorm.
 * User: LCH
 * Date: 2015/7/18
 * Time: 14:52
 */

namespace p2p\package\controllers\frontend;

use kiwi\Kiwi;
use kiwi\web\Controller;
use Yii;
use yii\data\ActiveDataProvider;

class PackageRecordController extends Controller
{
    public $layout = '/account';

    public function actionPackageList()
    {
        $packageRecordClass = Kiwi::getPackageRecordClass();

        $dataProvider = new ActiveDataProvider([
            'query' => $packageRecordClass::find()->andWhere([
                'member_id' => Yii::$app->user->id
            ]),
            'pagination' => [
                'pageSize' => 20,
            ],
        ]);

        $models = $dataProvider->getModels();

        return $this->render('package_list', [
            'models' => $models,
        ]);
    }

    public function actionIntoList()
    {
        $packageRecordClass = Kiwi::getPackageRecordClass();

        $dataProvider = new ActiveDataProvider([
            'query' => $packageRecordClass::find()->andWhere([
                'member_id' => Yii::$app->user->id,
                'type' => $packageRecordClass::TYPE_INTO
            ]),
            'pagination' => [
                'pageSize' => 20,
            ],
        ]);

        $models = $dataProvider->getModels();

        return $this->render('into_list', [
            'models' => $models,
        ]);
    }

    public function actionOutList()
    {
        $packageRecordClass = Kiwi::getPackageRecordClass();

        $dataProvider = new ActiveDataProvider([
            'query' => $packageRecordClass::find()->andWhere([
                'member_id' => Yii::$app->user->id,
                'type' => $packageRecordClass::TYPE_OUT
            ]),
            'pagination' => [
                'pageSize' => 20,
            ],
        ]);

        $models = $dataProvider->getModels();

        return $this->render('out_list', [
            'models' => $models,
        ]);
    }
}