<?php

namespace p2p\withdraw\models;

use kiwi\Kiwi;
use Yii;

/**
 * This is the model class for table "{{%deposit_record}}".
 *
 * @property integer $deposit_record_id
 * @property integer $member_id
 * @property string $money
 * @property string $counter_fee
 * @property string $deposit_type
 * @property string $verify_user
 * @property integer $verify_date
 * @property integer $create_time
 * @property integer $update_time
 * @property integer $is_delete
 *
 * @property \core\member\models\Member $member
 */
class DepositRecord extends \kiwi\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%deposit_record}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['member_id', 'money', 'counter_fee', 'create_time'], 'required'],
            [['member_id', 'verify_date', 'create_time', 'update_time', 'is_delete'], 'integer'],
            [['money', 'counter_fee'], 'number'],
            [['deposit_type'], 'string', 'max' => 45],
            [['verify_user'], 'string', 'max' => 80]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'deposit_record_id' => Yii::t('p2p_withdraw', 'Deposit Record ID'),
            'member_id' => Yii::t('p2p_withdraw', 'Member ID'),
            'money' => Yii::t('p2p_withdraw', 'Money'),
            'counter_fee' => Yii::t('p2p_withdraw', 'Counter Fee'),
            'deposit_type' => Yii::t('p2p_withdraw', 'Deposit Type'),
            'verify_user' => Yii::t('p2p_withdraw', 'Verify User'),
            'verify_date' => Yii::t('p2p_withdraw', 'Verify Date'),
            'create_time' => Yii::t('p2p_withdraw', 'Create Time'),
            'update_time' => Yii::t('p2p_withdraw', 'Update Time'),
            'is_delete' => Yii::t('p2p_withdraw', 'Is Delete'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMember()
    {
        return $this->hasOne(Kiwi::getMemberClass(), ['member_id' => 'member_id']);
    }
}
