<?php

namespace core\member\models;

use Yii;

/**
 * This is the model class for table "{{%member_coupon}}".
 *
 * @property integer $member_coupon_id
 * @property integer $member_id
 * @property integer $type
 * @property string $value
 * @property integer $used_time
 * @property string $expire_date
 * @property integer $status
 * @property integer $create_time
 * @property integer $update_time
 * @property integer $is_delete
 *
 * @property Member $member
 */
class MemberCoupon extends \kiwi\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%member_conpon}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['member_id', 'type', 'value', 'used_time', 'expire_date', 'create_time'], 'required'],
            [['member_id', 'type', 'used_time', 'status', 'create_time', 'update_time', 'is_delete'], 'integer'],
            [['expire_date'], 'safe'],
            [['value'], 'string', 'max' => 45]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'member_coupon_id' => Yii::t('core_member', 'Member Coupon ID'),
            'member_id' => Yii::t('core_member', 'Member ID'),
            'type' => Yii::t('core_member', 'Type'),
            'value' => Yii::t('core_member', 'Value'),
            'used_time' => Yii::t('core_member', 'Used Time'),
            'expire_date' => Yii::t('core_member', 'Expire Date'),
            'status' => Yii::t('core_member', 'Status'),
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
}
