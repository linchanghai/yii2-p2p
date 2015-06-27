<?php

namespace p2p\recharge\models;

use kiwi\Kiwi;
use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "{{%recharge_record}}".
 *
 * @property integer $recharge_record_id
 * @property string $transaction_id
 * @property integer $member_id
 * @property string $money
 * @property integer $recharge_type
 * @property string $use_for_type
 * @property integer $use_for_id
 * @property integer $status
 * @property integer $create_time
 * @property integer $update_time
 * @property integer $is_delete
 *
 * @property Member $member
 */
class RechargeRecord extends \kiwi\db\ActiveRecord
{
    const STATUS_PAYING = 0;
    const STATUS_SUCCESS = 1;
    const STATUS_FAIL = 2;
    const STATUS_ERROR = 3;

    const USE_FOR_TYPE_NULL = 0;
    const USE_FOR_TYPE_INVEST = 1;
    const USE_FOR_TYPE_TO_PACKAGE = 2;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%recharge_record}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['transaction_id', 'money', 'recharge_type'], 'required'],
            [['use_for_type', 'use_for_id', 'recharge_type', 'status'], 'integer'],
            [['money'], 'number'],
            [['transaction_id'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'recharge_record_id' => Yii::t('p2p_recharge', 'Recharge Record ID'),
            'transaction_id' => Yii::t('p2p_recharge', 'Transaction ID'),
            'member_id' => Yii::t('p2p_recharge', 'Member ID'),
            'use_for_type' => Yii::t('p2p_recharge', 'Use For Type'),
            'use_for_id' => Yii::t('p2p_recharge', 'Use For ID'),
            'money' => Yii::t('p2p_recharge', 'Money'),
            'recharge_type' => Yii::t('p2p_recharge', 'Recharge Type'),
            'status' => Yii::t('p2p_recharge', 'Status'),
            'create_time' => Yii::t('p2p_recharge', 'Create Time'),
            'update_time' => Yii::t('p2p_recharge', 'Update Time'),
            'is_delete' => Yii::t('p2p_recharge', 'Is Delete'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMember()
    {
        return $this->hasOne(Kiwi::getMemberClass(), ['member_id' => 'member_id']);
    }

    /**
     * @param $transactionId
     * @return RechargeRecord
     */
    public static function findByTransactionId($transactionId)
    {
        return static::findOne(['transaction_id' => $transactionId]);
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
