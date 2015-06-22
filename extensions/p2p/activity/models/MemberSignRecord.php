<?php

namespace p2p\activity\models;

use Yii;

/**
 * This is the model class for table "{{%member_sign_record}}".
 *
 * @property integer $member_sign_record_id
 * @property integer $member_id
 * @property string $target_date
 * @property integer $ponit
 * @property integer $create_time
 * @property integer $is_delete
 *
 * @property Member $member
 */
class MemberSignRecord extends \kiwi\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%member_sign_record}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['member_id', 'target_date', 'ponit', 'create_time', 'is_delete'], 'required'],
            [['member_id', 'ponit', 'create_time', 'is_delete'], 'integer'],
            [['target_date'], 'string', 'max' => 8]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'member_sign_record_id' => Yii::t('p2p_activity', 'Member Sign Record ID'),
            'member_id' => Yii::t('p2p_activity', 'Member ID'),
            'target_date' => Yii::t('p2p_activity', 'Target Date'),
            'ponit' => Yii::t('p2p_activity', 'Ponit'),
            'create_time' => Yii::t('p2p_activity', 'Create Time'),
            'is_delete' => Yii::t('p2p_activity', 'Is Delete'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMember()
    {
        return $this->hasOne(Member::className(), ['member_id' => 'member_id']);
    }
}
