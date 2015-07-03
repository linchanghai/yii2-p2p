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

class BindEmailForm extends Model
{
    public $email;
    public $status;

    public function rules()
    {
        return [
            ['email', 'email'],
        ];
    }

    public function __construct()
    {
        $memberModel = Yii::$app->user->identity;
        $this->email = $memberModel->email;
        $memberStatusModel = $memberModel->memberStatus;
        if ($memberStatusModel) {
            $this->status = $memberStatusModel->email_status;
        } else {
            $this->status = 0;
        }
    }

    /**
     * Sends an email with a link, for binding the email.
     * @return boolean whether the email was send
     */
    public function sendEmail()
    {
        $memberModel = Yii::$app->user->identity;
        $memberModel->email_verify_token = Yii::$app->security->generateRandomString() . '_' . time();
        if ($this->status) {
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
        } else {
            return false;
        }

    }

    public function setEmailStatus($token)
    {
        $memberModel = Kiwi::getMember()->find()->where(array('email_verify_token' => $token,'member_id'=>Yii::$app->user->id))->one();
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

} 