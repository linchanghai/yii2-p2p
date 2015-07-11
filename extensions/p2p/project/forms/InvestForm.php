<?php
/**
 * @link http://www.yincart.com/
 * @copyright Copyright (c) 2014 Yincart
 * @license http://www.yincart.com/license/
 */

namespace p2p\project\forms;


use kiwi\base\Model;
use kiwi\Kiwi;
use Yii;
use yii\base\Exception;

/**
 * Class InvestForm
 *
 * @property \p2p\project\models\Project $project
 * @property \p2p\project\models\ProjectInvest $invest
 * @method bool invest()
 *
 * @package p2p\project\forms
 * @author jeremy.zhou(gao_lujie@live.cn)
 */
class InvestForm extends Model
{
    const EVENT_BEFORE_INVEST = 'beforeInvest';
    const EVENT_AFTER_INVEST = 'afterInvest';

    /** @var int the project to invest */
    public $project_id;
    /** @var int the invest money */
    public $investMoney;
    /** @var int the bonus money to be used */
    public $bonusMoney;
    /** @var int the annual member coupon to be used */
    public $annual_id;
    /** @var int the cash member coupon to be used */
    public $cash_id;

    /** @var \p2p\project\models\Project */
    protected $_project;
    /** @var \p2p\project\models\ProjectInvest */
    protected $_invest;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        $memberCouponClass = Kiwi::getMemberCouponClass();
        $now = time();
        return [
            [['project_id', 'money'], 'required'],
            ['investMoney', 'number', 'integerOnly' => true, 'min' => $this->project->min_money, 'max' => $this->getMaxInvestMoney()],
            ['bonusMoney', 'number', 'integerOnly' => true, 'min' => 0, 'max' => $this->getMaxBonusMoney()],
            ['annual_id', 'exist', 'targetClass' => $memberCouponClass, 'targetAttribute' => 'member_coupon_id', 'filter' => ['type' => $memberCouponClass::TYPE_ANNUAL, 'status' => $memberCouponClass::STATUS_UNUSED, ['<', 'expire_date', $now]]],
            ['cash_id', 'exist', 'targetClass' => $memberCouponClass, 'targetAttribute' => 'member_coupon_id', 'filter' => ['type' => $memberCouponClass::TYPE_CASH, 'status' => $memberCouponClass::STATUS_UNUSED, ['<', 'expire_date', $now]]],
        ];
    }

    public function getMaxInvestMoney()
    {
        /** @var \core\member\models\Member $member */
        $member = Yii::$app->user->identity;
        $canInvestMoney = $this->project->invest_total_money - $this->project->invested_money;
        $maxInvestMoney = $canInvestMoney < $member->memberStatistic->account_money ? $canInvestMoney : $member->memberStatistic->account_money;
        return $maxInvestMoney;
    }

    public function getMaxBonusMoney()
    {
        /** @var \core\member\models\Member $member */
        $member = Yii::$app->user->identity;
        $maxBonusMoney = $this->investMoney * 0.01;
        $canUseBonus = $member->memberStatistic->bonus - $member->memberStatistic->used_bonus;
        $maxBonusMoney = $maxBonusMoney < $canUseBonus ? $maxBonusMoney : $canUseBonus;
        return $maxBonusMoney;
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'investMoney' => Yii::t('p2p_project', 'Invest Money'),
            'bonusMoney' => Yii::t('p2p_project', 'Bonus Money'),
            'annual_id' => Yii::t('p2p_project', 'Annual'),
            'cash_id' => Yii::t('p2p_project', 'Cash'),
        ];
    }

    /**
     * validate if the project exist and the project status is investing
     */
    public function getProject()
    {
        if (!$this->_project) {
            $projectClass = Kiwi::getProjectClass();
            $this->_project = $projectClass::findOne($this->project_id);
            if (!$this->_project || $this->_project->status != $projectClass::STATUS_INVESTING) {
                throw new Exception('Invalid Project ID');
            }
        }
        return $this->_project;
    }

    /**
     * @return \p2p\project\models\ProjectInvest
     * @throws Exception
     */
    public function getInvest()
    {
        if (!$this->_invest) {
            $invest = Kiwi::getProjectInvest();
            $invest->member_id = Yii::$app->user->id;
            $invest->project_id = $this->project_id;
            $invest->invest_money = $this->investMoney;
            $invest->actual_invest_money = $this->investMoney;
            $invest->rate = $this->project->interest_rate;

            $InterestHelperClass = Kiwi::getInterestHelperClass();
            list($totalInterestMoney, $repayments) = $InterestHelperClass::calculateInterest($this->investMoney, $invest->rate, time(), $this->getProject()->repayment_date, 20);

            $invest->interest_money = $totalInterestMoney;

            foreach ($repayments as $key => $repayment) {
                $repayments[$key] = Kiwi::getProjectRepayment([
                    'interest_money' => $repayment['interestMoney'],
                    'invest_money' => $repayment['principalMoney'],
                    'repayment_date' => $repayment['repaymentDate'],
                ]);
            }

            $invest->setRelation('projectRepayments', $repayments);
            $this->_invest = $invest;
        }
        return $this->_invest;
    }

    protected function investInternal()
    {
        return $this->invest->save();
    }
}