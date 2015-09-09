<?php

namespace p2p\transfer\models;

use Yii;

/**
 * This is the model class for table "{{%project_transfer_discount_record}}".
 *
 * @property integer $project_transfer_discount_record_id
 * @property integer $project_id
 * @property integer $project_invest_id
 * @property integer $member_id
 * @property string $rate
 * @property string $discount_money
 * @property integer $create_time
 * @property integer $is_delete
 *
 * @property Member $member
 * @property Project $project
 * @property ProjectInvest $projectInvest
 */
class ProjectTransferDiscountRecord extends \kiwi\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%project_transfer_discount_record}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['project_id', 'project_invest_id', 'member_id', 'create_time'], 'required'],
            [['project_id', 'project_invest_id', 'member_id', 'create_time', 'is_delete'], 'integer'],
            [['rate', 'discount_money'], 'number']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'project_transfer_discount_record_id' => Yii::t('p2p_transfer', 'Project Transfer Discount Record ID'),
            'project_id' => Yii::t('p2p_transfer', 'Project ID'),
            'project_invest_id' => Yii::t('p2p_transfer', 'Project Invest ID'),
            'member_id' => Yii::t('p2p_transfer', 'Member ID'),
            'rate' => Yii::t('p2p_transfer', 'Rate'),
            'discount_money' => Yii::t('p2p_transfer', 'Discount Money'),
            'create_time' => Yii::t('p2p_transfer', 'Create Time'),
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
