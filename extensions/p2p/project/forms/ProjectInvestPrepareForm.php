<?php
/**
 * Created by PhpStorm.
 * User: LCH
 * Date: 2015/6/22
 * Time: 11:25
 */

namespace p2p\project\forms;

use kiwi\Kiwi;
use Yii;
use kiwi\base\Model;

class ProjectInvestPrepareForm extends Model
{
    public $money;
    public $annual_id;
    public $project_id;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['money','project_id'], 'required'],
            [['annual_id'], 'number'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'money' => Yii::t('p2p_project', 'Money'),
            'project_id' => Yii::t('p2p_project', 'Project'),
            'annual_id' => Yii::t('p2p_project', 'Annual'),
        ];
    }

    public function calculateInvest()
    {
        if($this->validate()) {
            /** @var \p2p\project\models\Project $project */
            $project = Kiwi::getProject()->findOne($this->project_id);
            $invest = Kiwi::getProjectInvest();
            $invest->project_id = $project->project_id;
            $invest->member_id = Yii::$app->user->id;
            $invest->rate = $project->interest_rate;
            $invest->invest_money = $this->money;

            $backDay = 20;
            $repayments = [];
            $project->repayment_date;
            $repaymentDate = strtotime(date('Y-m-' . $backDay));
            $startDate = strtotime(date('Y-m-d'));
            $totalInterestMoney = 0;
            while ($repaymentDate < $project->repayment_date) {
                $days = ($repaymentDate - $startDate) / 3600 / 24;
                $interestMoney = $invest->invest_money * $project->interest_rate / 365 * $days;

                $repayment = Kiwi::getProjectRepayment();
                $repayment->interest_money = $interestMoney;
                $totalInterestMoney = $totalInterestMoney + $interestMoney;
                $repayment->invest_money = 0;
                $repayment->repayment_date = $repaymentDate;
                $repayments[] = $repayment;

                $startDate = $repaymentDate;
                $repaymentDate = strtotime('+1 month', $repaymentDate);
            }

            $repaymentDate = $project->repayment_date;
            $days = ($repaymentDate - $startDate) / 3600 / 24;
            $interestMoney = $invest->invest_money * $project->interest_rate / 365 * $days;
            $repayment = Kiwi::getProjectRepayment();
            $repayment->interest_money = $interestMoney;
            $totalInterestMoney = $totalInterestMoney + $interestMoney;
            $repayment->invest_money = $invest->invest_money;
            $repayments[] = $repayment;


            $invest->interest_money = $totalInterestMoney;

            $invest->setRelation('projectRepayments', $repayments);
            return $invest;
        }
    }
}