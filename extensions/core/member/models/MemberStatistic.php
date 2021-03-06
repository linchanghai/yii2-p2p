<?php

namespace core\member\models;

use kiwi\Kiwi;
use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "{{%member_statistic}}".
 *
 * @property integer $member_statistic_id
 * @property integer $member_id
 * @property float $account_money
 * @property float $freezon_money
 * @property float $package_money
 * @property float $is_auto_into
 * @property float $package_earning
 * @property integer $project_total_money
 * @property float $project_earning
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
 * @property integer $investingMoney
 *
 */
class MemberStatistic extends \kiwi\db\ActiveRecord
{
    use MemberTrait;

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
            [['project_total_money', 'points', 'bonus', 'used_bonus', 'empirical_value', 'is_first_invest'], 'integer', 'min' => 0],
            [['account_money', 'freezon_money', 'package_money', 'package_earning', 'project_earning', 'collect_principal', 'collect_interest'], 'number', 'min' => 0]
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
            'is_auto_into' => Yii::t('core_member', 'Is Auto Into'),
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

    public function getInvestingMoney()
    {
        $projectInvestClass = Kiwi::getProjectInvestClass();
        return $projectInvestClass::find()
            ->andWhere(['member_id' => Yii::$app->user->id])
            ->andWhere(['status' => $projectInvestClass::STATUS_REPAYMENT])
            ->sum('invest_money') ?: 0;
    }
}
