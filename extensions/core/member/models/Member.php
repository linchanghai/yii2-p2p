<?php

namespace core\member\models;

use core\user\models\User;
use kiwi\Kiwi;
use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "{{%member}}".
 *
 * @property integer $member_id
 * @property string $username
 * @property string $password_hash
 * @property string $password_reset_token
 * @property string $mobile
 * @property string $email
 * @property string $email_verify_token
 * @property string $real_name
 * @property string $id_card
 * @property string $recommend_user
 * @property string $recommend_type
 * @property string $auth_key
 * @property string $access_token
 * @property integer $status
 * @property integer $create_time
 * @property integer $update_time
 *
 */
class Member extends User
{
    use MemberTrait;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%member}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['username', 'password_hash'], 'required'],
            [['status', 'create_time', 'update_time', 'is_deleted'], 'integer'],
            [['username', 'recommend_user', 'recommend_type'], 'string', 'max' => 45],
            [['password_hash', 'email'], 'string', 'max' => 60],
            [['password_reset_token', 'access_token'], 'string', 'max' => 100],
            [['mobile'], 'string', 'max' => 11],
            [['email_verify_token'], 'string', 'max' => 120],
            [['real_name'], 'string', 'max' => 50],
            [['id_card'], 'string', 'max' => 18],
            [['auth_key'], 'string', 'max' => 32],
            [['username'], 'unique']
            //TODO: when mobileStatus or emailStatus = 0,you can change the value
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'member_id' => Yii::t('core_member', 'Member ID'),
            'username' => Yii::t('core_member', 'User Name'),
            'password_hash' => Yii::t('core_member', 'Password Hash'),
            'password_reset_token' => Yii::t('core_member', 'Password Reset Token'),
            'mobile' => Yii::t('core_member', 'Mobile'),
            'email' => Yii::t('core_member', 'Email'),
            'email_verify_token' => Yii::t('core_member', 'Email Verify Token'),
            'real_name' => Yii::t('core_member', 'Real Name'),
            'id_card' => Yii::t('core_member', 'Id Card'),
            'recommend_user' => Yii::t('core_member', 'Recommend User'),
            'recommend_type' => Yii::t('core_member', 'Recommend Type'),
            'auth_key' => Yii::t('core_member', 'Auth Key'),
            'access_token' => Yii::t('core_member', 'Access Token'),
            'status' => Yii::t('core_member', 'Status'),
            'create_time' => Yii::t('core_member', 'Create Time'),
            'update_time' => Yii::t('core_member', 'Update Time'),
            'is_deleted' => Yii::t('core_member', 'Is Deleted'),
        ];
    }

    /**
     * @inheritdoc
     */
    public static function find()
    {
        return parent::find()->where([]);
    }

    /**
     * @inheritdoc
     */
    public static function findIdentity($id)
    {
        return static::findOne(['member_id' => $id, 'status' => static::STATUS_ACTIVE]);
    }

    public function behaviors()
    {
        return [
            'time' => [
                'class' => TimestampBehavior::className(),
                'createdAtAttribute' => 'create_time',
                'updatedAtAttribute' => 'update_time',
            ],
        ];
    }
}
