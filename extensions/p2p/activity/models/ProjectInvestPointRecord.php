<?php

namespace p2p\activity\models;

use Yii;

/**
 * This is the model class for table "project_invest_point_record".
 *
 * @property integer $project_invest_point_record
 * @property integer $project_invest_record_id
 * @property integer $project_id
 * @property integer $member_id
 * @property integer $point
 * @property integer $project_type
 * @property integer $create_time
 * @property integer $is_delete
 */
class ProjectInvestPointRecord extends \kiwi\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'project_invest_point_record';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['project_invest_record_id', 'project_id', 'member_id', 'point', 'create_time'], 'required'],
            [['project_invest_record_id', 'project_id', 'member_id', 'point', 'project_type', 'create_time', 'is_delete'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'project_invest_point_record' => Yii::t('p2p_activity', 'Project Invest Point Record'),
            'project_invest_record_id' => Yii::t('p2p_activity', 'Project Invest Record ID'),
            'project_id' => Yii::t('p2p_activity', 'Project ID'),
            'member_id' => Yii::t('p2p_activity', 'Member ID'),
            'point' => Yii::t('p2p_activity', 'Point'),
            'project_type' => Yii::t('p2p_activity', 'Project Type'),
            'create_time' => Yii::t('p2p_activity', 'Create Time'),
            'is_delete' => Yii::t('p2p_activity', 'Is Delete'),
        ];
    }
}
