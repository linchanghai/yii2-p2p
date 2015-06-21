<?php

namespace p2p\activity\models;

use core\member\models\Member;
use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "project_invest".
 *
 * @property integer $project_invest_id
 * @property integer $project_id
 * @property integer $member_id
 * @property string $rate
 * @property integer $invest_money
 * @property string $interest_money
 * @property integer $create_time
 * @property integer $update_time
 * @property integer $status
 * @property integer $is_delete
 * @property integer $actual_invest_money
 *
 * @property ConponAnnualRecord[] $conponAnnualRecords
 * @property ConponBonusRecord[] $conponBonusRecords
 * @property ConponCashRecord[] $conponCashRecords
 * @property Project $member
 * @property Project $project
 * @property ProjectInvestPointRecord[] $projectInvestPointRecords
 * @property ProjectRepayment[] $projectRepayments
 */
class ProjectInvest extends \kiwi\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'project_invest';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['invest_money', 'interest_money'], 'required'],
            [['invest_money', 'create_time', 'status', 'actual_invest_money'], 'integer'],
            [['rate', 'interest_money'], 'number']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'project_invest_id' => Yii::t('p2p_activity', 'Project Invest ID'),
            'project_id' => Yii::t('p2p_activity', 'Project ID'),
            'member_id' => Yii::t('p2p_activity', 'Member ID'),
            'rate' => Yii::t('p2p_activity', 'Rate'),
            'invest_money' => Yii::t('p2p_activity', 'Invest Money'),
            'interest_money' => Yii::t('p2p_activity', 'Interest Money'),
            'create_time' => Yii::t('p2p_activity', 'Create Time'),
            'update_time' => Yii::t('p2p_activity', 'Update Time'),
            'status' => Yii::t('p2p_activity', 'Status'),
            'is_delete' => Yii::t('p2p_activity', 'Is Delete'),
            'actual_invest_money' => Yii::t('p2p_activity', 'Actual Invest Money'),
        ];
    }

    public function behaviors()
    {
        return [
            'time' => [
                'class' => TimestampBehavior::className(),
                'createdAtAttribute' => 'create_time',
                'updatedAtAttribute' => 'update_time',
            ]
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getConponAnnualRecords()
    {
        return $this->hasMany(ConponAnnualRecord::className(), ['project_invest_id' => 'project_invest_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getConponBonusRecords()
    {
        return $this->hasMany(ConponBonusRecord::className(), ['project_invest_id' => 'project_invest_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getConponCashRecords()
    {
        return $this->hasMany(ConponCashRecord::className(), ['project_invest_id' => 'project_invest_id']);
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
    public function getProjectInvestPointRecords()
    {
        return $this->hasMany(ProjectInvestPointRecord::className(), ['project_invest_id' => 'project_invest_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProjectRepayments()
    {
        return $this->hasMany(ProjectRepayment::className(), ['project_invest_id' => 'project_invest_id']);
    }
}
