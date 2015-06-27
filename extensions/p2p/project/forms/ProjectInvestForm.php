<?php
/**
 * Created by PhpStorm.
 * User: LCH
 * Date: 2015/6/22
 * Time: 11:30
 */

namespace p2p\project\forms;

use kiwi\Kiwi;
use Yii;
use kiwi\base\Model;
use yii\base\Event;
use yii\base\Exception;
use yii\base\ModelEvent;

class ProjectInvestForm extends Model
{
    const EVENT_BEFORE_PAY_INVEST = 'beforePayInvest';
    const EVENT_AFTER_PAY_INVEST = 'afterPayInvest';

    public $money;
    public $account_money;
    public $bank_money;
    public $invest_id;
    public $bonus_id;
    public $couponCash_id;

    /** @var \p2p\project\models\ProjectInvest */
    protected $_invest;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['money', 'invest_id'], 'required'],
            [['bonus_id', 'couponCash_id', 'account_money', 'bank_money'], 'number'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'money' => Yii::t('p2p_project', 'Money'),
            'invest_id' => Yii::t('p2p_project', 'Project Invest'),
            'bonus_id' => Yii::t('p2p_project', 'Bonus'),
            'couponCash_id' => Yii::t('p2p_project', 'CouponCash'),
        ];
    }

    public function payInvest()
    {
        if (!$this->validate()) {
            return false;
        }

        if ($this->beforePayInvest()) {
            $memberStatisticClass = Kiwi::getMemberStatisticClass();
            /** @var \core\member\models\MemberStatistic $memberStatistic */
            $memberStatistic = $memberStatisticClass::findOne(['member_id' => Yii::$app->user->id]);
            if ($memberStatistic->account_money >= $this->money) {
                $memberStatistic->account_money -= $this->money;
                if (!$memberStatistic->save()) {
                    throw new Exception('Save member statistic fail !');
                }
            } else {
                throw new Exception('Account balance is insufficient !');
            }
            $this->afterPayInvest();
        }

        return true;
    }

    public function beforePayInvest()
    {
        $event = new ModelEvent();
        $this->trigger(static::EVENT_BEFORE_PAY_INVEST, $event);
        return $event->isValid;
    }

    public function afterPayInvest()
    {
        $event = new ModelEvent();
        $this->trigger(static::EVENT_AFTER_PAY_INVEST, $event);
    }

    public function updateInvest()
    {
        $class = Kiwi::getProjectInvestFormClass();
        Event::on($class, $class::EVENT_AFTER_PAY_INVEST, function ($event) {
            /** @var \p2p\project\forms\ProjectInvestForm $form */
            $form = $event->sender;
            /** @var \p2p\project\models\ProjectInvest $invest */
            $invest = Kiwi::getProjectInvest()->findOne($form->invest_id);

            $InterestHelperClass = Kiwi::getInterestHelperClass();
            list($totalInterestMoney, $repayments) = $InterestHelperClass::calculateInterest($this->money, $invest->rate, time(), $invest->project->repayment_date, 20);

            foreach ($repayments as $key => $repayment) {
                $repayments[$key] = Kiwi::getProjectRepayment([
                    'interest_money' => $repayment['interestMoney'],
                    'invest_money' => $repayment['principalMoney'],
                    'repayment_date' => $repayment['repaymentDate'],
                ]);
            }

            $invest->interest_money = $totalInterestMoney;

            $invest->setRelation('projectRepayments', $repayments);

            $invest->actual_invest_money = $form->account_money + $form->bank_money;
            $invest->save();
        });
    }

    public function updateProject()
    {
        $class = Kiwi::getProjectInvestFormClass();
        Event::on($class, $class::EVENT_AFTER_PAY_INVEST, function ($event) {
            /** @var \p2p\project\forms\ProjectInvestForm $form */
            $form = $event->sender;
            /** @var \p2p\project\models\ProjectInvest $invest */
            $invest = Kiwi::getProjectInvest()->findOne($form->invest_id);
            $project = $invest->project;
            $project->invested_money += $form->money;
            $project->save();
        });
    }

    public function useBonus()
    {
        $class = Kiwi::getProjectInvestFormClass();
        Event::on($class, $class::EVENT_BEFORE_PAY_INVEST, function ($event) {
            /** @var \p2p\project\forms\ProjectInvestForm $form */
            $form = $event->sender;

            /** @var \p2p\activity\models\Activity $bonus */
            $bonus = Kiwi::getActivity()->findOne($form->bonus_id);

            $form->money -= $bonus->activity_send_value;
        });
    }

    public function useCash()
    {
        $class = Kiwi::getProjectInvestFormClass();
        Event::on($class, $class::EVENT_BEFORE_PAY_INVEST, function ($event) {
            /** @var \p2p\project\forms\ProjectInvestForm $form */
            $form = $event->sender;

            /** @var \p2p\activity\models\Activity $couponCash */
            $couponCash = Kiwi::getActivity()->findOne($form->couponCash_id);

            $form->money -= $couponCash->activity_send_value;
        });
    }
}