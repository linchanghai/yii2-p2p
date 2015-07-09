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
 * @property \p2p\project\models\Project project
 *
 * @package p2p\project\forms
 * @author jeremy.zhou(gao_lujie@live.cn)
 */
class InvestForm extends Model
{
    const EVENT_BEFORE_INVEST = 'beforeInvest';
    const EVENT_AFTER_INVEST = 'afterInvest';

    public $money;
    /** @var int the project to invest */
    public $project_id;
    /** @var int the annual member coupon to be used */
    public $annual_id;

    /** @var \p2p\project\models\Project */
    protected $_project;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['project_id', 'money'], 'required'],
            ['money', 'number', 'integerOnly' => true, 'min' => $this->project->min_money, 'max' => $this->project->invest_total_money - $this->project->invested_money],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'money' => Yii::t('p2p_project', 'Money'),
            'annual_id' => Yii::t('p2p_project', 'Annual'),
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

    public function invest()
    {
        if (!$this->validate()) {
            return false;
        }

        return $this->getInvestInfo()->save();
    }

    /**
     * @return \p2p\project\models\ProjectInvest
     * @throws Exception
     */
    public function getInvestInfo()
    {
        $invest = Kiwi::getProjectInvest();
        $invest->member_id = Yii::$app->user->id;
        $invest->project_id = $this->project_id;
        $invest->invest_money = $this->money;
        $invest->actual_invest_money = $this->money;
        $invest->rate = $this->project->interest_rate;

        $InterestHelperClass = Kiwi::getInterestHelperClass();
        list($totalInterestMoney, $repayments) = $InterestHelperClass::calculateInterest($this->money, $invest->rate, time(), $this->getProject()->repayment_date, 20);

        $invest->interest_money = $totalInterestMoney;

        foreach ($repayments as $key => $repayment) {
            $repayments[$key] = Kiwi::getProjectRepayment([
                'interest_money' => $repayment['interestMoney'],
                'invest_money' => $repayment['principalMoney'],
                'repayment_date' => $repayment['repaymentDate'],
            ]);
        }

        $invest->setRelation('projectRepayments', $repayments);
        return $invest;
    }
} 