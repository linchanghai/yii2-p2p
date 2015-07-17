<?php

namespace p2p\withdraw\models;

use kiwi\behaviors\RecordBehavior;
use kiwi\Kiwi;
use Yii;
use yii\base\Exception;
use yii\behaviors\TimestampBehavior;
use yii\helpers\Json;

/**
 * This is the model class for table "withdraw_record".
 *
 * @property integer $withdraw_record_id
 * @property integer $member_id
 * @property string $money
 * @property string $counter_fee
 * @property string $deposit_type
 * @property string $first_verify_user
 * @property integer $first_verify_date
 * @property string $first_verify_memo
 * @property string $second_verify_user
 * @property integer $second_verify_date
 * @property string $second_verify_memo
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

    public function scenarios()
    {
        return [
            static::SCENARIO_DEFAULT => ['member_id', 'money', 'counter_fee', 'deposit_type', 'status'],
            'insert' => ['member_id', 'money', 'counter_fee', 'deposit_type'],
            'firstVerify' => ['first_verify_memo', 'status'],
            'secondVerify' => ['second_verify_memo', 'status'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['member_id', 'money', 'counter_fee'], 'required'],
            [['member_id', 'first_verify_date', 'second_verify_date', 'status', 'create_time', 'update_time'], 'integer'],
            [['money', 'counter_fee'], 'number'],
            [['first_verify_memo', 'status'], 'required', 'on' => ['firstVerify']],
            [['second_verify_memo', 'status'], 'required', 'on' => ['secondVerify']],
//            [['deposit_type'], 'string', 'max' => 45],
            [['first_verify_user', 'second_verify_user', 'first_verify_memo', 'second_verify_memo'], 'string', 'max' => 80]
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
            'first_verify_memo' => Yii::t('p2p_withdraw', 'First Verify Memo'),
            'second_verify_user' => Yii::t('p2p_withdraw', 'Second Verify User'),
            'second_verify_date' => Yii::t('p2p_withdraw', 'Second Verify Date'),
            'second_verify_memo' => Yii::t('p2p_withdraw', 'Second Verify Memo'),
            'status' => Yii::t('p2p_withdraw', 'Status'),
            'create_time' => Yii::t('p2p_withdraw', 'Create Time'),
            'update_time' => Yii::t('p2p_withdraw', 'Update Time'),
            'is_delete' => Yii::t('p2p_withdraw', 'Is Delete'),
        ];
    }

    public function behaviors()
    {
        $changeRecordClass = Kiwi::getStatisticChangeRecordClass();
        return [
            'time' => [
                'class' => TimestampBehavior::className(),
                'createdAtAttribute' => 'create_time',
                'updatedAtAttribute' => 'update_time',
            ],
            'accountMoneyRecord' => [
                'class' => RecordBehavior::className(),
                'targetClass' => $changeRecordClass,
                'attributes' => [
                    'member_id' => 'member_id',
                    'type' => $changeRecordClass::TYPE_WITHDRAW_APPLY,
                    'attribute' => function() { return 'account_money'; },
                    'value' => function ($withdraw) {
                        return -($withdraw->money + $withdraw->counter_fee);
                    },
                ],
            ],
            'freezonMoneyRecord' => [
                'class' => RecordBehavior::className(),
                'targetClass' => $changeRecordClass,
                'attributes' => [
                    'member_id' => 'member_id',
                    'type' => $changeRecordClass::TYPE_WITHDRAW_APPLY,
                    'attribute' => function() { return 'freezon_money'; },
                    'value' => function ($withdraw) {
                        return $withdraw->money + $withdraw->counter_fee;
                    },
                ],
            ],
        ];
    }

    public function afterSave($insert, $changedAttributes)
    {
        $this->changeFreezeMoney();

        parent::afterSave($insert, $changedAttributes);
    }

    public function changeFreezeMoney()
    {
        $memberStatistic = Kiwi::getMemberStatistic();
        /** @var \core\member\models\MemberStatistic $memberStatistic */
        $memberStatistic = $memberStatistic::findOne(['member_id' => $this->member_id]);

        if ($this->status == static::STATUS_FAIL) {
            $this->unfreezonMoney();
        }
        if ($this->status == static::STATUS_SUCCESS) {
            $this->withdrawMoney();
        }

        $memberStatistic->save();
    }

    public function unfreezonMoney()
    {
        $changeRecordClass = Kiwi::getStatisticChangeRecordClass();
        $frezonMoneychangeRecord = Kiwi::getStatisticChangeRecord([
            'type' => $changeRecordClass::TYPE_WITHDRAW_FAIL,
            'attribute' => 'freezon_money',
            'value' => -($this->money + $this->counter_fee),
            'member_id' => $this->member_id,
            'link_id' => $this->primaryKey,
        ]);
        $accountMoneychangeRecord = Kiwi::getStatisticChangeRecord([
            'type' => $changeRecordClass::TYPE_WITHDRAW_FAIL,
            'attribute' => 'account_money',
            'value' => $this->money + $this->counter_fee,
            'member_id' => $this->member_id,
            'link_id' => $this->primaryKey,
        ]);
        if (!$frezonMoneychangeRecord->save()) {
            throw new Exception('Update account money error: ' . Json::encode($frezonMoneychangeRecord->getErrors()));
        }
        if (!$accountMoneychangeRecord->save()) {
            throw new Exception('Update account money error: ' . Json::encode($accountMoneychangeRecord->getErrors()));
        }
    }

    public function withdrawMoney()
    {
        $changeRecordClass = Kiwi::getStatisticChangeRecordClass();
        $frezonMoneychangeRecord = Kiwi::getStatisticChangeRecord([
            'type' => $changeRecordClass::TYPE_WITHDRAW_SUCCESS,
            'attribute' => 'freezon_money',
            'value' => -($this->money + $this->counter_fee),
            'member_id' => $this->member_id,
            'link_id' => $this->primaryKey,
        ]);
        if (!$frezonMoneychangeRecord->save()) {
            throw new Exception('Update account money error: ' . Json::encode($frezonMoneychangeRecord->getErrors()));
        }
    }
}
