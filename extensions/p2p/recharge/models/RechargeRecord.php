<?php

namespace p2p\recharge\models;

use kiwi\Kiwi;
use Yii;

/**
 * This is the model class for table "{{%recharge_record}}".
 *
 * @property integer $recharge_record_id
 * @property string $transaction_id
 * @property integer $member_id
 * @property string $use_for
 * @property integer $project_invest_id
 * @property string $money
 * @property integer $recharge_type
 * @property integer $status
 * @property integer $create_time
 * @property integer $update_time
 * @property integer $is_delete
 *
 * @property Member $member
 */
class RechargeRecord extends \kiwi\db\ActiveRecord
{
    const STATUS_SUCCESS = 1;
    const STATUS_FAIL = 2;
    const STATUS_ERROR = 3;

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
            [['member_id', 'transaction_id', 'money', 'recharge_type', 'create_time'], 'required'],
            [['member_id', 'project_invest_id', 'recharge_type', 'status', 'create_time', 'update_time', 'is_delete'], 'integer'],
            [['money'], 'number'],
            [['transaction_id'], 'string', 'max' => 100],
            [['use_for'], 'string', 'max' => 100]
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
            'use_for' => Yii::t('p2p_recharge', 'Use For'),
            'project_invest_id' => Yii::t('p2p_recharge', 'Project Invest ID'),
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
}
