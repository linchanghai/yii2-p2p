<?php

namespace p2p\activity\models;

use Yii;

/**
 * This is the model class for table "project_repayment_record".
 *
 * @property integer $project_repayment_record
 * @property integer $project_invest_record_id
 * @property integer $project_id
 * @property integer $member_id
 * @property string $interest_money
 * @property integer $invest_money
 * @property integer $repayment_date
 * @property integer $status
 * @property integer $create_time
 * @property integer $update_time
 * @property integer $is_delete
 */
class ProjectRepaymentRecord extends \kiwi\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'project_repayment_record';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['project_invest_record_id', 'project_id', 'member_id', 'interest_money', 'repayment_date', 'create_time'], 'required'],
            [['project_invest_record_id', 'project_id', 'member_id', 'invest_money', 'repayment_date', 'status', 'create_time', 'update_time', 'is_delete'], 'integer'],
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
            'project_invest_record_id' => Yii::t('p2p_activity', 'Project Invest Record ID'),
            'project_id' => Yii::t('p2p_activity', 'Project ID'),
            'member_id' => Yii::t('p2p_activity', 'Member ID'),
            'interest_money' => Yii::t('p2p_activity', 'Interest Money'),
            'invest_money' => Yii::t('p2p_activity', 'Invest Money'),
            'repayment_date' => Yii::t('p2p_activity', 'Repayment Date'),
            'status' => Yii::t('p2p_activity', 'Status'),
            'create_time' => Yii::t('p2p_activity', 'Create Time'),
            'update_time' => Yii::t('p2p_activity', 'Update Time'),
            'is_delete' => Yii::t('p2p_activity', 'Is Delete'),
        ];
    }
}
