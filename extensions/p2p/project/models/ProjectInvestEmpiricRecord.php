<?php

namespace p2p\project\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "project_invest_point_id".
 *
 * @property integer $project_invest_point_id
 * @property integer $project_invest_id
 * @property integer $project_id
 * @property integer $member_id
 * @property integer $empiric_value
 * @property integer $create_time
 * @property integer $is_delete
 *
 * @property Member $member
 * @property Project $project
 * @property ProjectInvest $projectInvest
 */
class ProjectInvestEmpiricRecord extends \kiwi\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'project_invest_empiric_record';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['point'], 'required'],
            [['point'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'project_invest_point_id' => Yii::t('p2p_project', 'Project Invest Point ID'),
            'project_invest_id' => Yii::t('p2p_project', 'Project Invest ID'),
            'project_id' => Yii::t('p2p_project', 'Project ID'),
            'member_id' => Yii::t('p2p_project', 'Member ID'),
            'point' => Yii::t('p2p_project', 'Point'),
            'create_time' => Yii::t('p2p_project', 'Create Time'),
            'is_delete' => Yii::t('p2p_project', 'Is Delete'),
        ];
    }

    public function behaviors()
    {
        return [
            'time' => [
                'class' => TimestampBehavior::className(),
                'createdAtAttribute' => 'create_time',
                'updatedAtAttribute' => false,
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
