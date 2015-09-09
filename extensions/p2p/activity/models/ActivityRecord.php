<?php

namespace p2p\activity\models;

use kiwi\behaviors\RecordBehavior;
use kiwi\Kiwi;
use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "activity_record".
 *
 * @property integer $activity_records_id
 * @property integer $member_id
 * @property integer $activity_id
 * @property string $note
 * @property string $create_time
 * @property integer $is_delete
 *
 * @property Activity $activity
 * @property \core\member\models\Member $member
 */
class ActivityRecord extends \kiwi\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'activity_record';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['member_id', 'activity_id'], 'required'],
            [['member_id', 'activity_id', 'is_delete'], 'integer'],
            [['note'], 'string', 'max' => 50],
            [['create_time'], 'string', 'max' => 45]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'activity_records_id' => Yii::t('p2p_activity', 'Activity Records ID'),
            'member_id' => Yii::t('p2p_activity', 'Member ID'),
            'activity_id' => Yii::t('p2p_activity', 'Activity ID'),
            'note' => Yii::t('p2p_activity', 'Note'),
            'create_time' => Yii::t('p2p_activity', 'Create Time'),
            'is_delete' => Yii::t('p2p_activity', 'Is Delete'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getActivity()
    {
        return $this->hasOne(Kiwi::getActivityClass(), ['activity_id' => 'activity_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMember()
    {
        return $this->hasOne(Kiwi::getMemberClass(), ['member_id' => 'member_id']);
    }

    public function behaviors()
    {
        return [
            'time' => [
                'class' => TimestampBehavior::className(),
                'createdAtAttribute' => 'create_time',
                'updatedAtAttribute' => false,
            ],
            'record' => $this->getRecordBehavior(),
        ];
    }

    public function getRecordBehavior()
    {
        $behavior = ['class' => RecordBehavior::className()];
        $activity = $this->activity;
        if ($activity->activity_send_type == $activity::SEND_TYPE_POINTS) {
            $statisticChangeRecordClass = Kiwi::getStatisticChangeRecordClass();
            $behavior['targetClass'] = $statisticChangeRecordClass;
            $behavior['attributes'] = [
                'type' => $statisticChangeRecordClass::TYPE_ACTIVITY_POINT,
                'value' => 'activity.activity_send_value',
                'member_id' => Yii::$app->user->id,
            ];
        } else {
            $memberCouponClass = Kiwi::getMemberCouponClass();
            $behavior['targetClass'] = $memberCouponClass;
            $behavior['attributes'] = [
                'value' => 'activity.activity_send_value',
                'member_id' => Yii::$app->user->id,
                'expire_date' => strtotime("+ {$activity->valid_date} day"),
            ];
            switch ($activity->activity_send_type) {
                case $activity::SEND_TYPE_ANNUAL:
                    $behavior['attributes']['type'] = $memberCouponClass::TYPE_ANNUAL;
                    break;
                case $activity::SEND_TYPE_BONUS:
                    $behavior['attributes']['type'] = $memberCouponClass::TYPE_BONUS;
                    break;
                case $activity::SEND_TYPE_CASH:
                    $behavior['attributes']['type'] = $memberCouponClass::TYPE_CASH;
                    break;
                default:
                    break;
            }
        }
        return $behavior;
    }
}
