<?php

namespace p2p\project\models;

use kiwi\Kiwi;
use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "project_repayment".
 *
 * @property integer $project_repayment_id
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
 * @property \core\member\models\Member $member
 * @property \core\member\models\MemberStatistic $memberStatistic
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
            'project_repayment_id' => Yii::t('p2p_project', 'Project Repayment ID'),
            'project_invest_id' => Yii::t('p2p_project', 'Project Invest ID'),
            'project_id' => Yii::t('p2p_project', 'Project ID'),
            'member_id' => Yii::t('p2p_project', 'Member ID'),
            'interest_money' => Yii::t('p2p_project', 'Interest Money'),
            'invest_money' => Yii::t('p2p_project', 'Invest Money'),
            'repayment_date' => Yii::t('p2p_project', 'Repayment Date'),
            'status' => Yii::t('p2p_project', 'Status'),
            'is_transfer' => Yii::t('p2p_project', 'Is Transfer'),
            'create_time' => Yii::t('p2p_project', 'Create Time'),
            'update_time' => Yii::t('p2p_project', 'Update Time'),
            'is_delete' => Yii::t('p2p_project', 'Is Delete'),
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
        return $this->hasOne(Kiwi::getMemberClass(), ['member_id' => 'member_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMemberStatistic()
    {
        return $this->hasOne(Kiwi::getMemberStatisticClass(), ['member_id' => 'member_id']);
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

    public function repayment()
    {
        if ($this->is_transfer) {
            return false;
        }

        $repaymentMoney = $this->interest_money + $this->invest_money;
        $changeRecordClass = Kiwi::getStatisticChangeRecordClass();
        $changeRecord = Kiwi::getStatisticChangeRecord(['type' => $changeRecordClass::TYPE_REPAYMENT]);
        $changeRecord->value = $repaymentMoney;
        return $changeRecord->save();
    }
}
