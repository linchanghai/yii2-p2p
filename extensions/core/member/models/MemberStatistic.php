<?php

namespace core\member\models;

use Yii;

/**
 * This is the model class for table "{{%member_statistic}}".
 *
 * @property integer $member_statistic_id
 * @property integer $member_id
 * @property string $account_money
 * @property string $freezon_money
 * @property string $package_money
 * @property string $package_earning
 * @property integer $project_total_money
 * @property string $project_earning
 * @property string $collect_principal
 * @property string $collect_interest
 * @property integer $points
 * @property integer $bonus
 * @property integer $used_bonus
 * @property integer $empirical_value
 * @property integer $is_first_invest
 * @property integer $create_time
 * @property integer $update_time
 * @property integer $is_delete
 *
 * @property Member $member
 */
class MemberStatistic extends \kiwi\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%member_statistic}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['member_id', 'create_time'], 'required'],
            [['member_id', 'project_total_money', 'points', 'bonus', 'used_bonus', 'empirical_value', 'is_first_invest', 'create_time', 'update_time', 'is_delete'], 'integer'],
            [['account_money', 'freezon_money', 'package_money', 'package_earning', 'project_earning', 'collect_principal', 'collect_interest'], 'number']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'member_statistic_id' => Yii::t('core_member', 'Member Statistic ID'),
            'member_id' => Yii::t('core_member', 'Member ID'),
            'account_money' => Yii::t('core_member', 'Account Money'),
            'freezon_money' => Yii::t('core_member', 'Freezon Money'),
            'package_money' => Yii::t('core_member', 'Package Money'),
            'package_earning' => Yii::t('core_member', 'Package Earning'),
            'project_total_money' => Yii::t('core_member', 'Project Total Money'),
            'project_earning' => Yii::t('core_member', 'Project Earning'),
            'collect_principal' => Yii::t('core_member', 'Collect Principal'),
            'collect_interest' => Yii::t('core_member', 'Collect Interest'),
            'points' => Yii::t('core_member', 'Points'),
            'bonus' => Yii::t('core_member', 'Bonus'),
            'used_bonus' => Yii::t('core_member', 'Used Bonus'),
            'empirical_value' => Yii::t('core_member', 'Empirical Value'),
            'is_first_invest' => Yii::t('core_member', 'Is First Invest'),
            'create_time' => Yii::t('core_member', 'Create Time'),
            'update_time' => Yii::t('core_member', 'Update Time'),
            'is_delete' => Yii::t('core_member', 'Is Delete'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMember()
    {
        return $this->hasOne(Member::className(), ['member_id' => 'member_id']);
    }
}
