<?php
namespace core\user\forms;

use kiwi\base\Model;
use kiwi\Kiwi;
use Yii;
use yii\base\ModelEvent;

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
        if (!$this->validate()) {
            return false;
        }

        if ($this->beforeSignup()) {
            /** @var \core\user\models\User $user */
            $user = Kiwi::createObject(Yii::$app->user->identityClass);
            $user->username = $this->username;
            $user->email = $this->email;
            $user->setPassword($this->password);
            $user->generateAuthKey();
            $user->status = 1;
            $user->save();

            $this->afterSignup();
            return $user;
        }

        return null;
    }

    const BEFORE_SIGNUP = 'beforeSignup';
    const AFTER_SIGNUP = 'afterSignup';

    public function beforeSignup()
    {
        $event = new ModelEvent();
        $this->trigger(static::BEFORE_SIGNUP, $event);
        return $event->isValid;
    }

    public function afterSignup()
    {
        $this->trigger(static::AFTER_SIGNUP);
    }
}
