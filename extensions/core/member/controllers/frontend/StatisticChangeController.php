<?php
/**
 * Created by PhpStorm.
 * User: LCH
 * Date: 2015/7/18
 * Time: 16:02
 */

namespace core\member\controllers\frontend;

use kiwi\helpers\ArrayHelper;
use kiwi\Kiwi;
use kiwi\web\Controller;
use Yii;
use yii\data\ActiveDataProvider;

class StatisticChangeController extends Controller
{
    public $layout = '/account';

    public function actionStatisticList()
    {
        $searchModel = Kiwi::getStatisticChangeRecordSearch();
        $dataProvider = $searchModel->search(ArrayHelper::merge(Yii::$app->request->queryParams, [
            'StatisticChangeRecordSearch' => [
                'member_id' => Yii::$app->user->id,
            ]]));

        $models = $dataProvider->getModels();

        return $this->render('statistic_list', [
            'models' => $models,
        ]);
    }
}