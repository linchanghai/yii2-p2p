<?php

namespace p2p\activity\models;

use Yii;

/**
 * This is the model class for table "activity".
 *
 * @property integer $activity_id
 * @property integer $activity_type
 * @property integer $activity_send_type
 * @property string $activity_send_value
 * @property integer $vaild_date
 * @property integer $create_time
 * @property integer $update_time
 * @property integer $is_delete
 *
 * @property ActivityRecord[] $activityRecords
 */
class Activity extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'activity';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['activity_type', 'activity_send_type', 'activity_send_value', 'create_time'], 'required'],
            [['activity_type', 'activity_send_type', 'vaild_date', 'create_time', 'update_time', 'is_delete'], 'integer'],
            [['activity_send_value'], 'string', 'max' => 45]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'activity_id' => Yii::t('p2p_activity', 'Activity ID'),
            'activity_type' => Yii::t('p2p_activity', 'Activity Type'),
            'activity_send_type' => Yii::t('p2p_activity', 'Activity Send Type'),
            'activity_send_value' => Yii::t('p2p_activity', 'Activity Send Value'),
            'vaild_date' => Yii::t('p2p_activity', 'Vaild Date'),
            'create_time' => Yii::t('p2p_activity', 'Create Time'),
            'update_time' => Yii::t('p2p_activity', 'Update Time'),
            'is_delete' => Yii::t('p2p_activity', 'Is Delete'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getActivityRecords()
    {
        return $this->hasMany(ActivityRecord::className(), ['activity_id' => 'activity_id']);
    }
}
