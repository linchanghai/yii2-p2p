<?php
namespace core\user\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use kiwi\db\ActiveRecord;
use yii\web\IdentityInterface;

/**
 * User model
 *
 * @property integer $id
 * @property integer $authKey
 *
 * @property integer $user_id
 * @property string $username
 * @property string $password_hash
 * @property string $password_reset_token
 * @property string $email
 * @property string $email_verify_token
 * @property string $phone
 * @property string $auth_key
 * @property string $access_token
 * @property integer $role
 * @property integer $status
 * @property integer $created_at
 * @property integer $updated_at
 * @property string $password write-only password
 */
class User extends ActiveRecord implements IdentityInterface
{
    const STATUS_DELETED = 0;
    const STATUS_ACTIVE = 1;
    const ROLE_USER = 1;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%user}}';
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['phone', 'email'], 'default', 'value' => ''],
            [['username'], 'required'],
            [['username', 'email'], 'string', 'max' => 255],
            ['phone', 'string', 'max' => 11, 'min' => 11],
            ['username', 'unique', 'targetClass' => Yii::$app->user->identityClass, 'filter' => function($query) {
                if (!$this->isNewRecord) {
                    $primaryKey = $this->primaryKey();
                    $primaryKey = $primaryKey[0];
                    /** @var \yii\db\Query $query */
                    $query->andWhere(['!=', $primaryKey, $this->id]);
                }
            }],

            ['status', 'default', 'value' => static::STATUS_ACTIVE],
            ['status', 'in', 'range' => [static::STATUS_ACTIVE, static::STATUS_DELETED]],

            ['role', 'default', 'value' => static::ROLE_USER],
            ['role', 'in', 'range' => [static::ROLE_USER]],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'user_id' => Yii::t('core_user', 'ID'),
            'username' => Yii::t('core_user', 'Username'),
            'password_hash' => Yii::t('core_user', 'Password Hash'),
            'password_reset_token' => Yii::t('core_user', 'Password Reset Token'),
            'email' => Yii::t('core_user', 'Email'),
            'email_verify_token' => Yii::t('core_user', 'Email Verify Token'),
            'phone' => Yii::t('core_user', 'Phone'),
            'auth_key' => Yii::t('core_user', 'Auth Key'),
            'access_token' => Yii::t('core_user', 'Access Token'),
            'role' => Yii::t('core_user', 'Role'),
            'status' => Yii::t('core_user', 'Status'),
            'created_at' => Yii::t('core_user', 'Created At'),
            'updated_at' => Yii::t('core_user', 'Updated At'),
        ];
    }

    /**
     * @inheritdoc
     */
    public static function find()
    {
        return parent::find()->andWhere(['role' => static::ROLE_USER]);
    }

    /**
     * @inheritdoc
     */
    public static function findIdentity($id)
    {
        return static::findOne(['user_id' => $id, 'status' => static::STATUS_ACTIVE]);
    }

    /**
     * @inheritdoc
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        return static::findOne(['access_token' => $token, 'status' => static::STATUS_ACTIVE]);
    }

    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
        return static::findOne(['username' => $username, 'status' => static::STATUS_ACTIVE]);
    }

    /**
     * Finds user by password reset token
     *
     * @param string $token password reset token
     * @return static|null
     */
    public static function findByPasswordResetToken($token)
    {
        if (!static::isPasswordResetTokenValid($token)) {
            return null;
        }

        return static::findOne([
            'password_reset_token' => $token,
            'status' => static::STATUS_ACTIVE,
        ]);
    }

    /**
     * Finds out if password reset token is valid
     *
     * @param string $token password reset token
     * @return boolean
     */
    public static function isPasswordResetTokenValid($token)
    {
        if (empty($token)) {
            return false;
        }
        $expire = Yii::$app->params['user.passwordResetTokenExpire'];
        $parts = explode('_', $token);
        $timestamp = (int) end($parts);
        return $timestamp + $expire >= time();
    }
    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->getPrimaryKey();
    }

    /**
     * @inheritdoc
     */
    public function getAuthKey()
    {
        return $this->auth_key;
    }

    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return boolean if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->password_hash);
    }
    /**
     * Generates password hash from password and sets it to the model
     *
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->password_hash = Yii::$app->security->generatePasswordHash($password);
    }

    /**
     * Validates pin password
     *
     * @param string $password pin password to validate
     * @return boolean if pin password provided is valid for current user
     */
    public function validatePinPassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->pin_password_hash);
    }

    /**
     * Generates "remember me" authentication key
     */
    public function generateAuthKey()
    {
        $this->auth_key = Yii::$app->security->generateRandomString();
    }

    public function generateAccessToken()
    {
        $this->access_token = Yii::$app->security->generateRandomString();
    }

    /**
     * Generates new password reset token
     */
    public function generatePasswordResetToken()
    {
        $this->password_reset_token = Yii::$app->security->generateRandomString() . '_' . time();
    }

    /**
     * Removes password reset token
     */
    public function removePasswordResetToken()
    {
        $this->password_reset_token = null;
    }

    /**
     * Generates new email verify token
     */
    public function generateEmailVerifyToken()
    {
        $this->email_verify_token = Yii::$app->security->generateRandomString() . '_' . time();
    }

    /**
     * Removes email verify token
     */
    public function removeEmailVerifyToken()
    {
        $this->email_verify_token = null;
    }
}
