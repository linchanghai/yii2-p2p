<?php
/**
 * @author Cangzhou.Wu(wucangzhou@gmail.com)
 * @Date 2015/6/24
 * @Time 10:32
 */
namespace p2p\activity\controllers\frontend;

use Yii;
use kiwi\Kiwi;
use kiwi\web\Controller;
class ActivityController extends Controller
{
    //todo  login



    public function actionCouponExchange(){
        $id = Yii::$app->request->post('id');
        $ProductMapClass = Kiwi::getProductMapClass();
        if (($model = $ProductMapClass::findOne($id)) !== null) {
            if(Kiwi::getExchangeRecord(['product_map_id'=>$id,'member_id'=>Yii::$app->user->id])->save()) {
                return json_encode(['message'=>'success']);
            }
        }
        return json_encode(['message'=>'fail']);
    }

    public function actionListCoupon(){
        $ProductMap = Kiwi::getProductMap()->find()->all();
        return $this->render('listCoupon',[
            'ProductMap'=>$ProductMap
        ]);
    }
} 