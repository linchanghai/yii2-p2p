<?php

namespace core\member\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "{{%member_status}}".
 *
 * @property integer $member_status_id
 * @property integer $member_id
 * @property integer $email_status
 * @property integer $mobile_status
 * @property integer $id_card_status
 * @property integer $create_time
 * @property integer $update_time
 * @property integer $is_delete
 *
 * @property Member $member
 */
class MemberStatus extends \kiwi\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%member_status}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['member_id', 'email_status', 'mobile_status', 'id_card_status'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'member_status_id' => Yii::t('core_member', 'Member Status ID'),
            'member_id' => Yii::t('core_member', 'Member ID'),
            'email_status' => Yii::t('core_member', 'Email Status'),
            'mobile_status' => Yii::t('core_member', 'Mobile Status'),
            'id_card_status' => Yii::t('core_member', 'Id Card Status'),
            'create_time' => Yii::t('core_member', 'Create Time'),
            'update_time' => Yii::t('core_member', 'Update Time'),
            'is_delete' => Yii::t('core_member', 'Is Delete'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMember()
    {
        return $this->hasOne(Member::className(), ['member_id' => 'member_id']);
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
