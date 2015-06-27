<?php

namespace core\member\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "{{%member_bank}}".
 *
 * @property integer $member_bank_id
 * @property integer $member_id
 * @property string $bank_name
 * @property string $card_no
 * @property string $bank_user_name
 * @property string $province
 * @property string $city
 * @property string $branch_name
 * @property integer $create_time
 * @property integer $update_time
 * @property integer $is_delete
 *
 * @property Member $member
 */
class MemberBank extends \kiwi\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%member_bank}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['member_id', 'bank_name', 'card_no', 'bank_user_name', 'province', 'city', 'branch_name'], 'required'],
            [['member_id', 'create_time', 'update_time', 'is_delete'], 'integer'],
            [['bank_name'], 'string', 'max' => 30],
            [['card_no'], 'string', 'max' => 25],
            [['bank_user_name'], 'string', 'max' => 10],
            [['province', 'city'], 'string', 'max' => 20],
            [['branch_name'], 'string', 'max' => 60],
            ['member_id','unique ']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'member_bank_id' => Yii::t('core_member', 'Member Bank ID'),
            'member_id' => Yii::t('core_member', 'Member ID'),
            'bank_name' => Yii::t('core_member', 'Bank Name'),
            'card_no' => Yii::t('core_member', 'Card No'),
            'bank_user_name' => Yii::t('core_member', 'Bank User Name'),
            'province' => Yii::t('core_member', 'Province'),
            'city' => Yii::t('core_member', 'City'),
            'branch_name' => Yii::t('core_member', 'Branch Name'),
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
