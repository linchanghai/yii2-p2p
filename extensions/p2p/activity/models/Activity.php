<?php

namespace p2p\activity\models;

use Yii;
use yii\behaviors\TimestampBehavior;

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
    const TYPE_BIND_EMAIL = 1;
    const TYPE_BIND_PHONE = 2;
    const TYPE_INVEST = 3;
    const TYPE_RECHARGE = 4;
    const TYPE_SHARE = 5;
    const TYPE_SUBSCRIBE = 6;
    const TYPE_APP = 7;

    const SEND_TYPE_POINTS = 1;
    const SEND_TYPE_ANNUAL = 2;
    const SEND_TYPE_BONUS = 3;
    const SEND_TYPE_CASH = 4;

    public function getActivityType(){
        return [
            self::TYPE_BIND_EMAIL => Yii::t('p2p_activity','Bind Email'),
            self::TYPE_BIND_PHONE => Yii::t('p2p_activity','Bind Phone'),
            self::TYPE_INVEST => Yii::t('p2p_activity','Invest'),
            self::TYPE_RECHARGE => Yii::t('p2p_activity','Recharge'),
            self::TYPE_SHARE => Yii::t('p2p_activity','Share'),
            self::TYPE_SUBSCRIBE => Yii::t('p2p_activity','Subscribe'),
            self::TYPE_APP => Yii::t('p2p_activity','App'),
        ];
    }

    public function getSendType(){
        return [
            self::SEND_TYPE_POINTS => Yii::t('p2p_activity','Points'),
            self::SEND_TYPE_ANNUAL => Yii::t('p2p_activity','Annual'),
            self::SEND_TYPE_BONUS => Yii::t('p2p_activity','Bonus'),
            self::SEND_TYPE_CASH => Yii::t('p2p_activity','Cash'),
        ];
    }
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
            [['activity_type', 'activity_send_type', 'activity_send_value',], 'required'],
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
}
