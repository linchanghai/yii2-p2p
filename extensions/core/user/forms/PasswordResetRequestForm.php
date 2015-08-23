<?php
namespace core\user\forms;

use kiwi\base\Model;
use kiwi\Kiwi;
use Yii;

/**
 * Class PasswordResetRequestForm
 * @package core\user\forms
 * @author Lujie.Zhou(lujie.zhou@jago-ag.cn)
 */
class PasswordResetRequestForm extends Model
{
    public $email;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        /** @var \core\user\models\User $userClass */
        $userClass = Yii::$app->user->identityClass;
        return [
            ['email', 'filter', 'filter' => 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'exist',
                'targetClass' => $userClass,
                'filter' => ['status' => $userClass::STATUS_ACTIVE],
                'message' => 'There is no user with such email.'
            ],
        ];
    }

    /**
     * Sends an email with a link, for resetting the password.
     *
     * @return boolean whether the email was send
     */
    public function sendEmail()
    {
        /** @var \core\user\models\User $userClass */
        $userClass = Yii::$app->user->identityClass;
        /** @var \core\user\models\User $user */
        $user = $userClass::findOne([
            'status' => $userClass::STATUS_ACTIVE,
            'email' => $this->email,
        ]);

        if ($user) {
            if (!$userClass::isPasswordResetTokenValid($user->password_reset_token)) {
                $user->generatePasswordResetToken();
            }

            if ($user->save()) {
                return Yii::$app->mailer->compose(['html' => 'passwordResetToken-html', 'text' => 'passwordResetToken-text'], ['user' => $user])
                    ->setFrom([Yii::$app->params['supportEmail'] => Yii::$app->name . ' robot'])
                    ->setTo($this->email)
                    ->setSubject('Password reset for ' . Yii::$app->name)
                    ->send();
            }
        }

        return false;
    }
}
