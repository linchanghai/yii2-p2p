<?php
/**
 * @author Cangzhou.Wu(wucangzhou@gmail.com)
 * @Date 2015/6/27
 * @Time 14:25
 */

namespace core\member\forms;


use kiwi\base\Model;
use kiwi\Kiwi;
use Yii;

class BindMobileForm extends Model
{
    public $mobile;
    public $code;
    public function rules()
    {
        return [
            ['mobile', 'string', 'min' => 11, 'max' => 11],
            ['mobile', 'number', 'integerOnly' => true],
            ['mobile', 'required'],
            ['code','integer']
        ];
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
        $memberStatusModel = Kiwi::getMemberStatus()->findOne(['member_id' => Yii::$app->user->id]);
        if($memberStatusModel->mobile_status){
           if($this->mobile != Yii::$app->user->identity->mobile) {
               $this->addError('mobile',Yii::t('core_member','The number is different from the mobile you bind'));
               return false;
           }
        }
        $code = $this->getCode(4);
        $session = Yii::$app->session;
        $session['mobile'] = ['code' => $code, 'time' => time()];
        //TODO:: sendMessage
        $message = Yii::t('core_member', '短信验证码：{code}', ['code' => $code]);
        return Yii::$app->sms->send($message, $this->mobile);
    }

    public function setMobileStatus()
    {
        $session = Yii::$app->session;
        if (time() - $session['mobile']['time'] > 300) {
            return false;
        }
        if ($session['mobile']['code'] != $this->code) {
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
            $member =  Yii::$app->user->identity;
            $memberStatusModel->mobile_status = 1;
            $member->mobile = $this->mobile;
            if ($memberStatusModel->save() && $member->save()) {
                $session->remove('mobile');
                return true;
            } else {
                return false;
            }
        }
    }
} 