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
 * Class PayInvestForm
 *
 * @property \p2p\project\models\ProjectInvest $invest
 *
 * @package p2p\project\forms
 * @author jeremy.zhou(gao_lujie@live.cn)
 */
class PayInvestForm extends Model
{
    public $investId;

    public $accountMoney;

    public $bonusMoney;

    public $cashCouponId;

    public $rechargeMoney;

    /** @var \p2p\project\models\ProjectInvest */
    private $_invest;

    public function rules()
    {
        /** @var \core\member\models\Member $member */
        $member = Yii::$app->user->identity;
        return [
            ['accountMoney', 'number', 'integerOnly' => true, 'min' => 0, 'max' => $member->memberStatistic->account_money],
        ];
    }

    public function attributeLabel()
    {
        return [
            'accountMoney' => Yii::t('p2p_project', 'Account Money'),
            'bonusMoney' => Yii::t('p2p_project', 'Bonus Money'),
            'cashCouponId' => Yii::t('p2p_project', 'Cash Coupon'),
            'rechargeMoney' => Yii::t('p2p_project', 'Recharge Money'),
        ];
    }

    public function getInvest()
    {
        if (!$this->_invest) {
            $investClass = Kiwi::getProjectInvestClass();
            $this->_invest = $investClass->findOne($this->investId);
            if (!$this->_invest || $this->_invest->status != $investClass::STATUS_PENDING) {
                throw new Exception('Invalid Invest ID');
            }
        }
        return $this->_invest;
    }

    public function payInvest()
    {
        $invest = $this->getInvest();
        $InterestHelperClass = Kiwi::getInterestHelperClass();
        list($totalInterestMoney, $repayments) = $InterestHelperClass::calculateInterest($invest->invest_money, $invest ->rate, time(), $this->getProject()->repayment_date, 20);

        $invest->interest_money = $totalInterestMoney;

        $projectRepayments = $invest->projectRepayments;
        foreach ($repayments as $key => $repayment) {
            $repayments[$key] = $projectRepayments ? array_shift($projectRepayments) : Kiwi::getProjectRepayment([
                'interest_money' => $repayment['interestMoney'],
                'invest_money' => $repayment['principalMoney'],
                'repayment_date' => $repayment['repaymentDate'],
            ]);
        }

        $invest->setRelation('projectRepayments', $repayments);

        return $invest->save();
    }
} 