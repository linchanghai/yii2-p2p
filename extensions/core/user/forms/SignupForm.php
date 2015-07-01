<?php
namespace core\user\forms;

use kiwi\base\Model;
use kiwi\Kiwi;
use Yii;

/**
 * Class SignupForm
 * @package core\user\forms
 * @author Lujie.Zhou(lujie.zhou@jago-ag.cn)
 */
class SignupForm extends Model
{
    public $username;
    public $email;
    public $password;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['username', 'filter', 'filter' => 'trim'],
            ['username', 'required'],
            ['username', 'unique', 'targetClass' => Yii::$app->user->identityClass, 'message' => 'This username has already been taken.'],
            ['username', 'string', 'min' => 2, 'max' => 255],

            ['email', 'filter', 'filter' => 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'unique', 'targetClass' => Yii::$app->user->identityClass, 'message' => 'This email address has already been taken.'],

            ['password', 'required'],
            ['password', 'string', 'min' => 6],
        ];
    }


    /**
     * Signs user up.
     *
     * @return \core\user\models\User|null the saved model or null if saving fails
     */
    public function signup()
    {
        if ($this->validate()) {
            /** @var \core\user\models\User $user */
            $user = Kiwi::createObject(Yii::$app->user->identityClass);
            $user->username = $this->username;
            $user->email = $this->email;
            $user->setPassword($this->password);
            $user->generateAuthKey();
            $user->status = 1;
            $user->save();
            return $user;
        }

        return null;
    }
}
