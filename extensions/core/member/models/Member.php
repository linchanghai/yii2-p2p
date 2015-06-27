<?php

namespace core\member\models;

use Yii;

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
 * @property integer $is_deleted
 *
 * @property MemberBank[] $memberBanks
 * @property MemberStatistic[] $memberStatistics
 * @property MemberStatus[] $memberStatuses
 */
class Member extends \kiwi\db\ActiveRecord
{
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
     * @return \yii\db\ActiveQuery
     */
    public function getActivityRecords()
    {
        return $this->hasMany(ActivityRecord::className(), ['member_id' => 'member_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getConponAnnualRecords()
    {
        return $this->hasMany(ConponAnnualRecord::className(), ['member_id' => 'member_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getConponBonusRecords()
    {
        return $this->hasMany(ConponBonusRecord::className(), ['member_id' => 'member_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getConponCashRecords()
    {
        return $this->hasMany(ConponCashRecord::className(), ['member_id' => 'member_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDepositRecords()
    {
        return $this->hasMany(DepositRecord::className(), ['member_id' => 'member_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getExchangeRecords()
    {
        return $this->hasMany(ExchangeRecord::className(), ['member_id' => 'member_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMemberBanks()
    {
        return $this->hasMany(MemberBank::className(), ['member_id' => 'member_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMemberConpons()
    {
        return $this->hasMany(MemberCoupon::className(), ['member_id' => 'member_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMemberStatistic()
    {
        return $this->hasOne(MemberStatistic::className(), ['member_id' => 'member_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMemberStatus()
    {
        return $this->hasOne(MemberStatus::className(), ['member_id' => 'member_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPackageRecords()
    {
        return $this->hasMany(PackageRecord::className(), ['member_id' => 'member_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProjectInvestPointRecords()
    {
        return $this->hasMany(ProjectInvestPointRecord::className(), ['member_id' => 'member_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProjectRepayments()
    {
        return $this->hasMany(ProjectRepayment::className(), ['member_id' => 'member_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRechargeRecords()
    {
        return $this->hasMany(RechargeRecord::className(), ['member_id' => 'member_id']);
    }
}
