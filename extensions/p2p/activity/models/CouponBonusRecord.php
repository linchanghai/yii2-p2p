<?php

namespace p2p\activity\models;

use core\member\models\Member;
use p2p\project\models\Project;
use p2p\project\models\ProjectInvest;
use Yii;

/**
 * This is the model class for table "{{%coupon_bonus_record}}".
 *
 * @property integer $coupon_bonus_record_id
 * @property integer $project_invest_id
 * @property integer $project_id
 * @property integer $member_id
 * @property integer $discount_money
 * @property integer $create_time
 * @property integer $is_delete
 *
 * @property Member $member
 * @property Project $project
 * @property ProjectInvest $projectInvest
 */
class CouponBonusRecord extends \kiwi\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%coupon_bonus_record}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['coupon_bonus_record_id', 'project_invest_id', 'project_id', 'member_id', 'discount_money', 'create_time', 'is_delete'], 'required'],
            [['coupon_bonus_record_id', 'project_invest_id', 'project_id', 'member_id', 'discount_money', 'create_time', 'is_delete'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'coupon_bonus_record_id' => Yii::t('p2p_activity', 'Coupon Bonus Record ID'),
            'project_invest_id' => Yii::t('p2p_activity', 'Project Invest ID'),
            'project_id' => Yii::t('p2p_activity', 'Project ID'),
            'member_id' => Yii::t('p2p_activity', 'Member ID'),
            'discount_money' => Yii::t('p2p_activity', 'Discount Money'),
            'create_time' => Yii::t('p2p_activity', 'Create Time'),
            'is_delete' => Yii::t('p2p_activity', 'Is Delete'),
        ];
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
