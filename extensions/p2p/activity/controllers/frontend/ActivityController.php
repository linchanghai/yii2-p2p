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
    public function actionCouponExchange($id){
        $ProductMapClass = Kiwi::getProductMapClass();
        if (($model = $ProductMapClass::findOne($id)) !== null) {
            if(Kiwi::getExchangeRecord(['product_map_id'=>$id,'member_id'=>Yii::$app->user->id])->save()) {
                return json_encode('success');
            }
        }
        return json_encode('fail');
    }
} 