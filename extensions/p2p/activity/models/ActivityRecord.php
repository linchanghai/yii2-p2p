<?php

namespace p2p\activity\models;

use Yii;

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
 * @property Member $member
 */
class ActivityRecord extends \yii\db\ActiveRecord
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
            [['member_id', 'activity_id', 'create_time'], 'required'],
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
        return $this->hasOne(Activity::className(), ['activity_id' => 'activity_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMember()
    {
        return $this->hasOne(Member::className(), ['member_id' => 'member_id']);
    }

}
