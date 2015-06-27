<?php
/**
 * @author Cangzhou.Wu(wucangzhou@gmail.com)
 * @Date 2015/6/27
 * @Time 14:25
 */

namespace core\member\models;


use kiwi\base\Model;
use kiwi\Kiwi;
use Yii;

class BindMEForm extends Model
{
    public $email;

    public $mobile;

    public function rules()
    {
        return [
            ['email', 'email'],
            ['mobile', 'integer']
        ];
    }

    /**
     * Sends an email with a link, for binding the email.
     * @return boolean whether the email was send
     */
    public function sendEmail()
    {
        $memberModel = Kiwi::getMember()->find()->where(['member_id' => Yii::$app->user->id])->one();
        if ($memberModel) {
            $memberModel->email_verify_token = Yii::$app->security->generateRandomString() . '_' . time();
            $memberStatusModel = $memberModel->memberStatus;
            if ($memberStatusModel->email_status) {
                $email = $memberModel->email;
            } else {
                $email = $this->email;
            }
            if ($memberModel->save()) {
                return Yii::$app->mailer->compose('emailResetToken', ['email' => $memberModel, 'user' => Yii::$app->user->identity])
                    ->setFrom(Yii::$app->params['supportEmail'])
                    ->setTo($email)
                    ->setSubject('email reset for ' . Yii::$app->name)
                    ->send();
            }
        }
        return false;
    }

    public function setEmailStatus($token)
    {
        $memberModel = Kiwi::getMember()->find()->where(array('email_verify_token' => $token))->one();
        if ($memberModel) {
            $memberStatusModel = $memberModel->memberStatus;
            if ($memberStatusModel->email_status == 0) {
                $memberStatusModel->email_status = 1;
                if ($memberStatusModel->save()) {
                    return true;
                }
            } else {
                $memberStatusModel->email_status = 0;
                if ($memberStatusModel->save()) {
                    return true;
                }
            }
        }
        return false;
    }

    /**
     * create mobile code
     * @param $length
     * @return string
     */
    public function getCode($length)
    {
        $key = '';
        for ($i = 0; $i < $length; $i++) {
            $key .= mt_rand(0, 9);
        }
        return $key;

    }

    public function sendMobileCode()
    {
        $code = $this->getCode(4);
        $session = Yii::$app->session;
        $session['mobile'] = ['code' => $code, 'time' => time()];
        //TODO:: sendMessage
//                $result = Kiwi::getSmsService()->instance()->send($code, $mobile);
//            $result = Json::decode($result);
//            if ($result['statusCode'] == '000000') {
//                return true;
//            } else {
//                return false;
//            }

    }

    public function setMobileStatus($mobileCode)
    {
        $session = Yii::$app->session;
        if (time() - $session['mobile']['time'] > 300) {
            return false;
        }
        if ($session['mobile']['code'] != $mobileCode) {
            return false;
        }
        /** @var  $memberStatusModel  MemberStatus */
        $memberStatusModel = Kiwi::getMemberStatus()->findOne(['member_id' => Yii::$app->user->id]);
        //解绑
        if ($memberStatusModel->mobile_status) {
            $memberStatusModel->mobile_status = 0;
            if ($memberStatusModel->save()) {
                $session->remove('mobile');
                return true;
            } else {
                return false;
            }
        } else {
            //绑定
            $memberModel = Kiwi::getMember()->findOne(['member_id' => Yii::$app->user->id]);
            $memberStatusModel->mobile_status = 1;
            $memberModel->mobile = $this->mobile;
            if ($memberModel->save() && $memberModel->save()) {
                $session->remove('mobile');
                return true;
            } else {
                return false;
            }
        }
    }
} 