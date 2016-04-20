<?php

namespace p2p\activity\models;

use core\member\models\StatisticChangeRecord;
use kiwi\behaviors\RecordBehavior;
use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "{{%project_invest_empiric_record}}".
 *
 * @property integer $project_invest_point_record
 * @property integer $project_invest_id
 * @property integer $project_id
 * @property integer $member_id
 * @property integer $empiric_value
 * @property integer $create_time
 * @property integer $is_delete
 */
class ProjectInvestEmpiricRecord extends \kiwi\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%project_invest_empiric_record}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['project_invest_id', 'project_id', 'member_id', 'empiric_value', 'create_time'], 'required'],
            [['project_invest_id', 'project_id', 'member_id', 'empiric_value', 'create_time', 'is_delete'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'project_invest_point_record' => Yii::t('p2p_activity', 'Project Invest Point Record'),
            'project_invest_id' => Yii::t('p2p_activity', 'Project Invest ID'),
            'project_id' => Yii::t('p2p_activity', 'Project ID'),
            'member_id' => Yii::t('p2p_activity', 'Member ID'),
            'empiric_value' => Yii::t('p2p_activity', 'Empiric Value'),
            'create_time' => Yii::t('p2p_activity', 'Create Time'),
            'is_delete' => Yii::t('p2p_activity', 'Is Delete'),
        ];
    }

    public function behaviors()
    {
        return [
            'coupon' => [
                'class' => RecordBehavior::className(),
                'targetClass' => StatisticChangeRecord::className(),
                'attributes' => [
                    'member_id'=> 'member_id',
                    'type' => StatisticChangeRecord::TYPE_INVEST_EMPIRICAL,
                    'value' => 'empiric_value',
                ],
            ],
            'time' => [
                'class' => TimestampBehavior::className(),
                'createdAtAttribute' => 'create_time'
            ],
        ];
    }
}
