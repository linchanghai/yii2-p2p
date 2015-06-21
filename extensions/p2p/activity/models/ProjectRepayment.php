<?php

namespace p2p\activity\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "project_repayment".
 *
 * @property integer $project_repayment_record
 * @property integer $project_invest_id
 * @property integer $project_id
 * @property integer $member_id
 * @property string $interest_money
 * @property integer $invest_money
 * @property integer $repayment_date
 * @property integer $status
 * @property integer $is_transfer
 * @property integer $create_time
 * @property integer $update_time
 * @property integer $is_delete
 *
 * @property Member $member
 * @property Project $project
 * @property ProjectInvest $projectInvest
 */
class ProjectRepayment extends \kiwi\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'project_repayment';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['interest_money', 'repayment_date'], 'required'],
            [['invest_money', 'repayment_date', 'status', 'is_transfer'], 'integer'],
            [['interest_money'], 'number']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'project_repayment_record' => Yii::t('p2p_activity', 'Project Repayment Record'),
            'project_invest_id' => Yii::t('p2p_activity', 'Project Invest ID'),
            'project_id' => Yii::t('p2p_activity', 'Project ID'),
            'member_id' => Yii::t('p2p_activity', 'Member ID'),
            'interest_money' => Yii::t('p2p_activity', 'Interest Money'),
            'invest_money' => Yii::t('p2p_activity', 'Invest Money'),
            'repayment_date' => Yii::t('p2p_activity', 'Repayment Date'),
            'status' => Yii::t('p2p_activity', 'Status'),
            'is_transfer' => Yii::t('p2p_activity', 'Is Transfer'),
            'create_time' => Yii::t('p2p_activity', 'Create Time'),
            'update_time' => Yii::t('p2p_activity', 'Update Time'),
            'is_delete' => Yii::t('p2p_activity', 'Is Delete'),
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
