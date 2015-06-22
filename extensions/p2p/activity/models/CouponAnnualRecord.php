<?php

namespace p2p\activity\models;

use Yii;

/**
 * This is the model class for table "{{%coupon_annual_record}}".
 *
 * @property integer $coupon_annual_record_id
 * @property integer $project_invest_id
 * @property integer $project_id
 * @property integer $member_id
 * @property integer $member_coupon_id
 * @property string $rate
 * @property string $interst_money
 * @property integer $create_time
 * @property integer $is_delete
 *
 * @property MemberCoupon $memberCoupon
 * @property Member $member
 * @property Project $project
 * @property ProjectInvest $projectInvest
 */
class CouponAnnualRecord extends \kiwi\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%coupon_annual_record}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['coupon_annual_record_id', 'project_invest_id', 'project_id', 'member_id', 'member_coupon_id', 'rate', 'interst_money', 'create_time'], 'required'],
            [['coupon_annual_record_id', 'project_invest_id', 'project_id', 'member_id', 'member_coupon_id', 'create_time', 'is_delete'], 'integer'],
            [['rate', 'interst_money'], 'number'],
            [['coupon_annual_record_id'], 'unique']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'coupon_annual_record_id' => Yii::t('p2p_activity', 'Coupon Annual Record ID'),
            'project_invest_id' => Yii::t('p2p_activity', 'Project Invest ID'),
            'project_id' => Yii::t('p2p_activity', 'Project ID'),
            'member_id' => Yii::t('p2p_activity', 'Member ID'),
            'member_coupon_id' => Yii::t('p2p_activity', 'Member Coupon ID'),
            'rate' => Yii::t('p2p_activity', 'Rate'),
            'interst_money' => Yii::t('p2p_activity', 'Interst Money'),
            'create_time' => Yii::t('p2p_activity', 'Create Time'),
            'is_delete' => Yii::t('p2p_activity', 'Is Delete'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMemberCoupon()
    {
        return $this->hasOne(MemberCoupon::className(), ['member_coupon_id' => 'member_coupon_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMember()
    {
        return $this->hasOne(Member::className(), ['member_id' => 'member_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProject()
    {
        return $this->hasOne(Project::className(), ['project_id' => 'project_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProjectInvest()
    {
        return $this->hasOne(ProjectInvest::className(), ['project_invest_id' => 'project_invest_id']);
    }
}
