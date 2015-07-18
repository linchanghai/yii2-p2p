<?php
/**
 * Created by PhpStorm.
 * User: LCH
 * Date: 2015/7/18
 * Time: 16:02
 */

namespace core\member\controllers\frontend;

use kiwi\Kiwi;
use kiwi\web\Controller;
use Yii;
use yii\data\ActiveDataProvider;

class StatisticChangeController extends Controller
{
    public $layout = '/account';

    public function actionStatisticList()
    {
        $statisticChangeRecordClass = Kiwi::getStatisticChangeRecordClass();

        $dataProvider = new ActiveDataProvider([
            'query' => $statisticChangeRecordClass::find()->andWhere([
                'member_id' => Yii::$app->user->id,
            ]),
            'pagination' => [
                'pageSize' => 20,
            ],
        ]);

        $models = $dataProvider->getModels();

        return $this->render('statistic_list', [
            'models' => $models,
        ]);
    }
}