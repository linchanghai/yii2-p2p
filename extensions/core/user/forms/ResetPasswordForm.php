<?php
namespace core\user\forms;

use kiwi\base\Model;
use kiwi\Kiwi;
use Yii;
use yii\base\InvalidParamException;

/**
 * Class ResetPasswordForm
 * @package core\user\forms
 * @author Lujie.Zhou(lujie.zhou@jago-ag.cn)
 */
class ResetPasswordForm extends Model
{
    public $password;
    /**
     * @var \core\user\models\User
     */
    private $_user;
    /**
     * Creates a form model given a token.
     *
     * @param  string                          $token
     * @param  array                           $config name-value pairs that will be used to initialize the object properties
     * @throws \yii\base\InvalidParamException if token is empty or not valid
     */
    public function __construct($token, $config = [])
    {
        /** @var \core\user\models\User $userClass */
        $userClass = Yii::$app->user->identityClass;
        if (empty($token) || !is_string($token)) {
            throw new InvalidParamException('Password reset token cannot be blank.');
        }
        $this->_user = $userClass::findByPasswordResetToken($token);
        if (!$this->_user) {
            throw new InvalidParamException('Wrong password reset token.');
        }
        parent::__construct($config);
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['password', 'required'],
            ['password', 'string', 'min' => 6],
        ];
    }

    /**
     * Resets password.
     *
     * @return boolean if password was reset.
     */
    public function resetPassword()
    {
        $user = $this->_user;
        $user->setPassword($this->password);
        $user->removePasswordResetToken();
        return $user->save(false);
    }
}
