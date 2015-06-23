<?php

namespace p2p\transfer\models;

use Yii;

/**
 * This is the model class for table "{{%project_invest_transfer_apply}}".
 *
 * @property integer $project_invest_transfer_apple
 * @property integer $project_invest_id
 * @property integer $project_id
 * @property integer $member_id
 * @property integer $min_money
 * @property integer $total_invest_money
 * @property string $discount_rate
 * @property integer $status
 * @property string $verify_user
 * @property integer $verify_date
 * @property string $counter_fee
 * @property integer $create_time
 * @property integer $update_time
 * @property integer $is_delete
 *
 * @property Member $member
 * @property Project $project
 * @property ProjectInvest $projectInvest
 */
class ProjectInvestTransferApply extends \kiwi\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%project_invest_transfer_apply}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['project_invest_id', 'project_id', 'member_id', 'total_invest_money', 'create_time'], 'required'],
            [['project_invest_id', 'project_id', 'member_id', 'min_money', 'total_invest_money', 'status', 'verify_date', 'create_time', 'update_time', 'is_delete'], 'integer'],
            [['discount_rate', 'counter_fee'], 'number'],
            [['verify_user'], 'string', 'max' => 80]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'project_invest_transfer_apple' => Yii::t('p2p_transfer', 'Project Invest Transfer Apple'),
            'project_invest_id' => Yii::t('p2p_transfer', 'Project Invest ID'),
            'project_id' => Yii::t('p2p_transfer', 'Project ID'),
            'member_id' => Yii::t('p2p_transfer', 'Member ID'),
            'min_money' => Yii::t('p2p_transfer', 'Min Money'),
            'total_invest_money' => Yii::t('p2p_transfer', 'Total Invest Money'),
            'discount_rate' => Yii::t('p2p_transfer', 'Discount Rate'),
            'status' => Yii::t('p2p_transfer', 'Status'),
            'verify_user' => Yii::t('p2p_transfer', 'Verify User'),
            'verify_date' => Yii::t('p2p_transfer', 'Verify Date'),
            'counter_fee' => Yii::t('p2p_transfer', 'Counter Fee'),
            'create_time' => Yii::t('p2p_transfer', 'Create Time'),
            'update_time' => Yii::t('p2p_transfer', 'Update Time'),
            'is_delete' => Yii::t('p2p_transfer', 'Is Delete'),
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
