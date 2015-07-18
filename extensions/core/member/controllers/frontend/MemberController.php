<?php
/**
 * @author Cangzhou.Wu(wucangzhou@gmail.com)
 * @Date 2015/7/1
 * @Time 9:49
 */

namespace core\member\controllers\frontend;

use core\member\forms\ResetPasswordForm;
use kartik\helpers\Html;
use kiwi\Kiwi;
use kiwi\web\Controller;
use Yii;
use yii\helpers\Json;
use yii\helpers\Url;

class MemberController extends Controller
{
    public function actionSaveRealName(){
        $model = Kiwi::getUserVerifyForm();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['/member/member/member-info']);
        }
            return $this->render('realNameVerify', [
                'model' => $model,
            ]);

    }

    public function actionMemberBank(){
        /** @var \core\member\models\MemberBank $model */
        $model = Yii::$app->user->identity->memberBank;
        if(!$model){
            $model = Kiwi::getMemberBank(['member_id'=>Yii::$app->user->id]);
        }

        $area = Kiwi::getArea()->find()->where(['parent_id'=>100000])->all();
        $catList = [];

        foreach($area as $s){
            $catList[$s->area_id] = $s->name;
        }

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->render('memberBank', [
                'model' => $model,
                'catList' => $catList,
            ]);
        } else {
            return $this->render('memberBank', [
                'model' => $model,
                'catList' => $catList,
            ]);
        }
    }

    /**
     * get cities list
     */
    public function actionGetCities() {
        $out = [];
        if (isset($_POST['depdrop_parents'])) {
            $parents = $_POST['depdrop_parents'];
            if ($parents != null) {
                $cat_id = $parents[0];
                $out = Kiwi::getArea()->getList($cat_id);
                echo Json::encode(['output'=>$out, 'selected'=>'']);
                return;
            }
        }
        echo Json::encode(['output'=>'', 'selected'=>'']);
    }

    public function actionSendEmail(){
        $model = Kiwi::getBindEmailForm();
        if( $model->sendEmail()){
            echo Html::button( '已经发送邮件' ) ;
        }else{
            echo Html::button( '发送邮件失败' );
        }
    }

    public function actionBindEmail($token){
        $model = Kiwi::getBindEmailForm();
        if($model->setEmailStatus($token)){
            return $this->render('success');
        }else{
            return $this->render('fail');
        }
    }

    public function actionBindPhone(){
        $model = Kiwi::getBindMobileForm(['mobile'=>Yii::$app->user->identity->mobile]);
        if(Yii::$app->request->isPost){
            if($model->load(Yii::$app->request->post())&&$model->setMobileStatus()){
                $this->redirect(['/member/member/member-info']);
            }else{
                $model->addError('code',Yii::t('core_member','code is wrong'));
            }
        }

        return $this->render('bindPhone',[
            'model'=>$model
        ]);
    }
    public function actionSendMobileCode(){
        $model = Kiwi::getBindMobileForm();
        if($model->load(Yii::$app->request->post())&&$model->sendMobileCode()){
            echo Json::encode(['message'=>Yii::t('core_member','send code success. mobile number :'.$model->mobile)]);
        }else{
            echo Json::encode(['message'=>Yii::t('core_member','send code fail')]);
        }
    }

    public function actionMemberInfo(){
        return $this->render('memberInfo',[
            'member'=>Yii::$app->user->identity,
            'memberStatus'=>Yii::$app->user->identity->memberStatus,
        ]);
    }

    public function actionResetPassword()
    {
        $model = Kiwi::getNewPasswordForm();

        if ($model->load(Yii::$app->request->post()) && $model->resetPassword()) {
            Yii::$app->user->logout();
            Yii::$app->getSession()->setFlash('success','Reset Password Success!');
            return $this->redirect(['/site/login']);
//            return $this->render('index',[
//                'customer' => $this->findModel(Yii::$app->user->id),
//            ]);
        } else {
            return $this->render('resetPassword', [
                'model' => $model,
            ]);
        }
    }
} 