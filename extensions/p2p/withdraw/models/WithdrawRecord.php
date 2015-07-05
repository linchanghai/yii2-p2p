<?php

namespace p2p\withdraw\models;

use Yii;

/**
 * This is the model class for table "deposit_record".
 *
 * @property integer $deposit_record_id
 * @property integer $member_id
 * @property string $money
 * @property string $counter_fee
 * @property string $deposit_type
 * @property string $first_verify_user
 * @property integer $first_verify_date
 * @property string $second_verify_user
 * @property integer $second_verify_date
 * @property integer $status
 * @property integer $create_time
 * @property integer $update_time
 * @property integer $is_delete
 */
class WithdrawRecord extends \kiwi\db\ActiveRecord
{
    const TYPE_AUTO = 1;
    const TYPE_MANUAL = 2;

    const STATUS_PENDING = 0;
    const STATUS_SUCCESS = 1;
    const STATUS_FAIL = 2;
    const STATUS_FIRST_VERIFY_SUCCESS = 3;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'deposit_record';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['member_id', 'money', 'counter_fee', 'create_time'], 'required'],
            [['member_id', 'first_verify_date', 'second_verify_date', 'status', 'create_time', 'update_time', 'is_delete'], 'integer'],
            [['money', 'counter_fee'], 'number'],
            [['deposit_type'], 'string', 'max' => 45],
            [['first_verify_user', 'second_verify_user'], 'string', 'max' => 80]
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
            'first_verify_user' => Yii::t('p2p_withdraw', 'First Verify User'),
            'first_verify_date' => Yii::t('p2p_withdraw', 'First Verify Date'),
            'second_verify_user' => Yii::t('p2p_withdraw', 'Second Verify User'),
            'second_verify_date' => Yii::t('p2p_withdraw', 'Second Verify Date'),
            'status' => Yii::t('p2p_withdraw', 'Status'),
            'create_time' => Yii::t('p2p_withdraw', 'Create Time'),
            'update_time' => Yii::t('p2p_withdraw', 'Update Time'),
            'is_delete' => Yii::t('p2p_withdraw', 'Is Delete'),
        ];
    }
}