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
        $productMapModel =  Kiwi::getProductMap();

        $CouponBonus =$productMapModel->find()->where(['type'=>$productMapModel::CouponBonus])->limit(4)->all();
        $CouponCash = $productMapModel->find()->where(['type'=>$productMapModel::CouponCash])->limit(4)->all();
        $CouponAnnual= $productMapModel->find()->where(['type'=>$productMapModel::CouponAnnual])->limit(2)->all();
        return $this->render('listCoupon',[
            'CouponBonus'=>$CouponBonus,
            'CouponCash'=>$CouponCash,
            'CouponAnnual'=>$CouponAnnual,
        ]);
    }


    public function actionView($id){
        $productMapModel =  Kiwi::getProductMap()->findOne($id);

        if(Yii::$app->request->isPost){
            $quantity = Yii::$app->request->post('quantity') ;
            if (($model = $productMapModel->findOne($id)) !== null) {
                if(Kiwi::getExchangeRecord(['product_map_id'=>$id,'member_id'=>Yii::$app->user->id,'quantity'=>$quantity])->save()) {
                    Yii::$app->session->setFlash('success',Yii::t('p2p_activity','exchange success'));
                }
            }
        }

        return $this->render('exchange',[
            'productMapModel'=>$productMapModel,
        ]);
    }
} 