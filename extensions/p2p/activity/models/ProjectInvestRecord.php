<?php

namespace p2p\activity\models;

use Yii;

/**
 * This is the model class for table "project_invest_record".
 *
 * @property integer $project_invest_record_id
 * @property integer $project_id
 * @property integer $member_id
 * @property string $rate
 * @property integer $invest_money
 * @property string $interest_money
 * @property integer $create_time
 * @property integer $update_time
 * @property integer $status
 * @property integer $is_delete
 */
class ProjectInvestRecord extends \kiwi\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'project_invest_record';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['project_id', 'member_id', 'invest_money', 'interest_money', 'create_time'], 'required'],
            [['project_id', 'member_id', 'invest_money', 'create_time', 'update_time', 'status', 'is_delete'], 'integer'],
            [['rate', 'interest_money'], 'number']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'project_invest_record_id' => Yii::t('p2p_activity', 'Project Invest Record ID'),
            'project_id' => Yii::t('p2p_activity', 'Project ID'),
            'member_id' => Yii::t('p2p_activity', 'Member ID'),
            'rate' => Yii::t('p2p_activity', 'Rate'),
            'invest_money' => Yii::t('p2p_activity', 'Invest Money'),
            'interest_money' => Yii::t('p2p_activity', 'Interest Money'),
            'create_time' => Yii::t('p2p_activity', 'Create Time'),
            'update_time' => Yii::t('p2p_activity', 'Update Time'),
            'status' => Yii::t('p2p_activity', 'Status'),
            'is_delete' => Yii::t('p2p_activity', 'Is Delete'),
        ];
    }
}
