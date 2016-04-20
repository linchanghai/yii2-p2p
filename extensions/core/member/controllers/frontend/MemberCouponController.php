<?php
/**
 * @author Cangzhou.Wu(wucangzhou@gmail.com)
 * @Date 2015/7/1
 * @Time 9:49
 */

namespace core\member\controllers\frontend;

use core\member\models\MemberCoupon;
use kiwi\Kiwi;
use kiwi\web\Controller;
use Yii;
use yii\data\ActiveDataProvider;
use yii\helpers\Json;

class MemberCouponController extends Controller
{
    public $layout = '/account';

    public function actionBonusView(){
        $memberBonus = Yii::$app->user->identity->memberStatistic;
        $dataProvider = new ActiveDataProvider([
            'query' => MemberCoupon::find()->andWhere(['member_id'=>Yii::$app->user->id,'type'=>MemberCoupon::TYPE_BONUS]),
            'pagination' => [
                'pageSize' => 20,
            ],
        ]);
        $models = $dataProvider->getModels();
        return $this->render('bonusView', [
            'models' => $models,
            'bonus' => $memberBonus,
        ]);
    }

    public function actionCashView(){
        $query = MemberCoupon::find()->andWhere(['member_id'=>Yii::$app->user->id,'type'=>MemberCoupon::TYPE_CASH]);
        $status = Yii::$app->request->get('status');
        if ($status !== null) {
            $status = $status ? MemberCoupon::STATUS_USED : MemberCoupon::STATUS_UNUSED;
            $query = $query->andWhere(['status'=>$status]);
        }
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 20,
            ],
        ]);
        $models = $dataProvider->getModels();
        return $this->render('cashView', [
            'models' => $models,
            'page'=>$dataProvider->pagination,
        ]);
    }

    public function actionAnnualView(){
        $query = MemberCoupon::find()->andWhere(['member_id'=>Yii::$app->user->id,'type'=>MemberCoupon::TYPE_ANNUAL]);
        $status = Yii::$app->request->get('status');
        if ($status !== null) {
            $status = $status ? MemberCoupon::STATUS_USED : MemberCoupon::STATUS_UNUSED;
            $query = $query->andWhere(['status'=>$status]);
        }

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 20,
            ],
        ]);
        $models = $dataProvider->getModels();
        return $this->render('annualView', [
            'models' => $models,
            'page'=>$dataProvider->pagination,
        ]);
    }
} 