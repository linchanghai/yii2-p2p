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
use yii\base\Event;
use yii\base\Exception;
use yii\base\InvalidValueException;
use yii\base\ModelEvent;

/**
 * Class ProjectInvestPrepareForm
 *
 * @property \p2p\project\models\Project $project
 *
 * @package p2p\project\forms
 * @author 1079140464@qq.com
 */
class ProjectInvestPrepareForm extends Model
{
    const EVENT_BEFORE_INVEST = 'beforeInvest';
    const EVENT_AFTER_INVEST = 'afterInvest';

    public $money;
    public $annual_id;
    public $project_id;
    public $invest;

    /** @var \p2p\project\models\Project */
    protected $_project;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['money', 'project_id'], 'required'],
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

    public function getInvestInfo()
    {
        if (!$this->validate()) {
            return false;
        }

        if ($this->beforeInvest()) {
            $this->invest = $this->calculateInvest();
            $this->afterInvest();
        }

        return $this->invest;
    }

    /**
     * @return null|\p2p\project\models\Project|static
     */
    protected function getProject()
    {
        if (!$this->_project) {
            $this->_project = Kiwi::getProject()->findOne($this->project_id);
            if (!$this->_project) {
                throw new InvalidValueException();
            }
        }
        return $this->_project;
    }

    /**
     * @return \p2p\project\models\ProjectInvest
     */
    public function calculateInvest()
    {
        $invest = Kiwi::getProjectInvest();
        $invest->project_id = $this->getProject()->project_id;
        $invest->member_id = Yii::$app->user->id;
        $invest->rate = $this->getProject()->interest_rate;
        $invest->invest_money = $this->money;

        $InterestHelperClass = Kiwi::getInterestHelperClass();
        list($totalInterestMoney, $repayments) = $InterestHelperClass::calculateInterest($this->money, $invest->rate, time(), $this->getProject()->repayment_date, 20);

        foreach ($repayments as $key => $repayment) {
            $repayments[$key] = Kiwi::getProjectRepayment([
                'interest_money' => $repayment['interestMoney'],
                'invest_money' => $repayment['principalMoney'],
                'repayment_date' => $repayment['repaymentDate'],
            ]);
        }

        $invest->interest_money = $totalInterestMoney;

        $invest->setRelation('projectRepayments', $repayments);
        return $invest;
    }

    public function beforeInvest()
    {
        $event = new ModelEvent();
        $this->trigger(static::EVENT_BEFORE_INVEST, $event);
        return $event->isValid;
    }

    public function afterInvest()
    {
        $event = new ModelEvent();
        $this->trigger(static::EVENT_AFTER_INVEST, $event);
    }

    public function useAnnual()
    {
        $class = Kiwi::getProjectInvestPrepareFormClass();
        Event::on($class, $class::EVENT_BEFORE_INVEST, function ($event) {
            /** @var \p2p\project\forms\ProjectInvestPrepareForm $form */
            $form = $event->sender;

            /** @var \p2p\activity\models\Activity $annual */
            $annual = Kiwi::getActivity()->findOne($form->annual_id);

            $form->getProject()->interest_rate += $annual->activity_send_value;
        });
    }

    public function saveInvest()
    {
        /** @var \p2p\project\models\ProjectInvest $invest */
        $invest = $this->calculateInvest();
        if ($invest->save()) {
            return true;
        } else {
            throw new Exception('Save invest fail !');
        }
    }
}