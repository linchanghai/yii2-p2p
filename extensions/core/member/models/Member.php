<?php

namespace core\member\models;

use core\user\models\User;
use Yii;

/**
 * This is the model class for table "{{%member}}".
 *
 * @property integer $member_id
 * @property string $user_name
 * @property string $password
 * @property string $mobile
 * @property string $email
 * @property string $email_vaild_code
 * @property string $real_name
 * @property string $id_card
 * @property string $recomend_user
 * @property string $recomend_type
 * @property integer $status
 * @property integer $create_time
 * @property integer $update_time
 * @property integer $is_deleted
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
            [['user_name', 'password'], 'required'],
            [['status', 'create_time', 'update_time', 'is_deleted'], 'integer'],
            [['user_name', 'recomend_user', 'recomend_type'], 'string', 'max' => 45],
            [['password', 'email'], 'string', 'max' => 60],
            [['mobile'], 'string', 'max' => 11],
            [['email_vaild_code'], 'string', 'max' => 120],
            [['real_name'], 'string', 'max' => 50],
            [['id_card'], 'string', 'max' => 18],
            [['user_name'], 'unique']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'member_id' => Yii::t('core_member', 'Member ID'),
            'user_name' => Yii::t('core_member', 'User Name'),
            'password' => Yii::t('core_member', 'Password'),
            'mobile' => Yii::t('core_member', 'Mobile'),
            'email' => Yii::t('core_member', 'Email'),
            'email_vaild_code' => Yii::t('core_member', 'Email Vaild Code'),
            'real_name' => Yii::t('core_member', 'Real Name'),
            'id_card' => Yii::t('core_member', 'Id Card'),
            'recomend_user' => Yii::t('core_member', 'Recomend User'),
            'recomend_type' => Yii::t('core_member', 'Recomend Type'),
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
}
