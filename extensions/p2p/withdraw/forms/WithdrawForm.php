<?php
/**
 * @link http://www.yincart.com/
 * @copyright Copyright (c) 2014 Yincart
 * @license http://www.yincart.com/license/
 */

namespace p2p\withdraw\forms;

use kiwi\base\Model;
use kiwi\Kiwi;
use yii;
use yii\base\ModelEvent;
use yii\base\Event;

class WithdrawForm extends Model
{
    const EVENT_BEFORE_WITHDRAW = 'beforeWithdraw';
    const EVENT_AFTER_WITHDRAW = 'afterWithdraw';

    public $withdrawMoney;

    public $actualWithdrawMoney;

    public $canWithdrawMoney;

    public $withdrawFee;

    public function rules()
    {
        return [
            [['withdrawMoney', 'canWithdrawMoney', 'withdrawFee'], 'required'],
            [['withdrawMoney', 'canWithdrawMoney', 'withdrawFee'], 'number', 'min' => 0],
            [['withdrawMoney', 'canWithdrawMoney', 'withdrawFee'], 'validateMoney'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'withdrawMoney' => Yii::t('p2p_withdraw', 'Withdraw Money'),
            'canWithdrawMoney' => Yii::t('p2p_withdraw', 'Can Withdraw Money'),
            'withdrawFee' => Yii::t('p2p_withdraw', 'Withdraw Fee'),
        ];
    }

    public function validateMoney()
    {
        $memberStatistic = Kiwi::getMemberStatistic();
        /** @var \core\member\models\MemberStatistic $memberStatistic */
        $memberStatistic = $memberStatistic::findOne(['member_id' => Yii::$app->user->id]);

        $this->canWithdrawMoney = $memberStatistic->account_money;

        if ($this->withdrawMoney + $this->withdrawFee > $this->canWithdrawMoney) {
            $this->addError('withdrawMoney', '可提现金额不足！');
        }
    }

    public function withdraw()
    {
        if (!$this->validate()) {
            return false;
        }

        if ($this->beforeWithdraw()) {
            $result = $this->createWithdrawRecord();
            $this->afterWithdraw();
        } else {
            $result = false;
        }

        return $result;
    }

    public function createWithdrawRecord()
    {
        $withdrawRecordClass = Kiwi::getWithdrawRecordClass();
        $withdrawRecord = Kiwi::getWithdrawRecord([
            'member_id' => Yii::$app->user->id,
            'counter_fee' => $this->withdrawFee,
            'money' => $this->withdrawMoney,
            'status' => $withdrawRecordClass::STATUS_PENDING,
            'deposit_type' => $withdrawRecordClass::TYPE_MANUAL
        ]);

        $withdrawRecord->scenario = 'insert';

        if (!$withdrawRecord->save()) {
            $this->addError('withdrawMoney', yii\helpers\Json::encode($withdrawRecord->getErrors()));
            return false;
        }

        return true;
    }

    public function beforeWithdraw()
    {
        $event = new ModelEvent();
        $this->trigger(static::EVENT_BEFORE_WITHDRAW, $event);
        return $event->isValid;
    }

    public function afterWithdraw()
    {
        $event = new ModelEvent();
        $this->trigger(static::EVENT_AFTER_WITHDRAW, $event);
    }
}