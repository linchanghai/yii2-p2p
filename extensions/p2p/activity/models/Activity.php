<?php

namespace p2p\activity\models;

use kiwi\Kiwi;
use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "activity".
 *
 * @property integer $activity_id
 * @property integer $activity_type
 * @property integer $activity_send_type
 * @property float $activity_send_value
 * @property integer $valid_date
 * @property integer $create_time
 * @property integer $update_time
 * @property integer $is_delete
 *
 * @property ActivityRecord[] $activityRecords
 */
class Activity extends \kiwi\db\ActiveRecord
{
    const SEND_TYPE_POINTS = 1;
    const SEND_TYPE_ANNUAL = 2;
    const SEND_TYPE_BONUS = 3;
    const SEND_TYPE_CASH = 4;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%activity}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['activity_type', 'activity_send_type', 'activity_send_value',], 'required'],
            [['activity_type', 'activity_send_type', 'valid_date'], 'integer'],
            ['activity_type', 'in', 'range' => array_keys(Yii::$app->dataList->activityTypes)],
            ['activity_send_type', 'in', 'range' => array_keys(Yii::$app->dataList->activitySendTypes)],
            [['activity_send_value'], 'number', 'min' => 0],
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
            'valid_date' => Yii::t('p2p_activity', 'Valid Date'),
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

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'time' => [
                'class' => TimestampBehavior::className(),
                'createdAtAttribute' => 'create_time',
                'updatedAtAttribute' => 'update_time',
            ],
        ];
    }

    public function getActivityEvent()
    {
        return Yii::$app->dataList->activityTypeEvents[$this->activity_type];
    }

    public function saveRecord()
    {
        return Kiwi::getActivityRecord([
            'member_id' => Yii::$app->user->id,
            'activity_id' => $this->activity_id
        ])->save();
    }
}
