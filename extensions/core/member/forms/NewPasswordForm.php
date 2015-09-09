<?php
namespace core\member\forms;

use kiwi\base\Model;
use kiwi\Kiwi;
use Yii;

/**
 * NewPassword form
 */
class NewPasswordForm extends Model
{
    public $old_password;
    public $new_password;
    public $confirm_password;

    private $_user = false;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['old_password', 'filter', 'filter' => 'trim'],
            [['old_password','new_password','confirm_password'], 'required'],
            [['old_password','new_password','confirm_password'], 'string', 'min' => 6],

            // password is validated by validatePassword()
            ['old_password', 'validatePassword'],
            ['new_password', 'validateNewPassword'],

            ['confirm_password', 'compare','compareAttribute'=>'new_password'],
        ];
    }

    /**
     * reset user password.
     *
     * @return User|null the saved model or null if saving fails
     */
    public function resetPassword()
    {
        if ($this->validate()) {
            $user = $this->getUser();
            $user->setPassword($this->new_password);
            $user->save();
            return $user;
        }

        return null;
    }

    public function attributeLabels()
    {
        return [
            'old_password' => Yii::t('core_member', 'Old Password'),
            'new_password' => Yii::t('core_member', 'New Password'),
            'confirm_password' => Yii::t('core_member', 'Sure Password'),
        ];
    }

    /**
     * Validates the password.
     * This method serves as the inline validation for password.
     */
    public function validatePassword()
    {
        if (!$this->hasErrors()) {
            $user = $this->getUser();
            if (!$user->validatePassword($this->old_password)) {
                $this->addError('old_password', Yii::t('app','Incorrect old password.'));
            }
        }
    }

    public function validateNewPassword()
    {
        if($this->old_password == $this->new_password) {
            $this->addError('new_password',Yii::t('app','The new password can not be the same as the old password.'));
        }
    }

    /**
     * Finds user by [[username]]
     *
     * @return User|null
     */
    public function getUser()
    {
        if ($this->_user === false) {
            $this->_user = Kiwi::getMember()->findOne(["member_id" => Yii::$app->user->id]);
        }

        return $this->_user;
    }
}
