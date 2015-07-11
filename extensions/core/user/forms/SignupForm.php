<?php
namespace core\user\forms;

use kiwi\base\Model;
use kiwi\Kiwi;
use Yii;
use yii\base\ModelEvent;

/**
 * Class SignupForm
 *
 * @method void signup()
 *
 * @package core\user\forms
 * @author Lujie.Zhou(lujie.zhou@jago-ag.cn)
 */
class SignupForm extends Model
{
    public $username;
    public $email;
    public $password;

    public $user;

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
     * @return mixed
     */
    protected function signupInternal()
    {
        /** @var \core\user\models\User $user */
        $this->user = Kiwi::createObject(Yii::$app->user->identityClass);
        $this->user->username = $this->username;
        $this->user->email = $this->email;
        $this->user->setPassword($this->password);
        $this->user->generateAuthKey();
        $this->user->status = 1;
        $this->user->save();
        return $this->user;
    }
}
