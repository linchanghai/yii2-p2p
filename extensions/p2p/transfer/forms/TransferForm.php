<?php
/**
 * Created by PhpStorm.
 * Author: changhai.lin<1079140464@qq.com>
 * Date: 2015/7/31
 * Time: 9:45
 */

namespace p2p\transfer\forms;

use kiwi\Kiwi;
use Yii;
use kiwi\base\Model;
use yii\base\Exception;

/**
 * Class TransferForm
 *
 * @property \p2p\project\models\ProjectInvest $invest
 *
 * @package p2p\transfer\forms
 * @author changhai.lin<1079140464@qq.com>
 */
class TransferForm extends Model
{
    const EVENT_BEFORE_TRANSFER = 'beforeTransfer';
    const EVENT_AFTER_TRANSFER = 'afterTransfer';

    public $project_invest_id;
    public $min_money;
    public $transfer_money;
    public $discount_rate;
    public $counter_fee;

    /** @var \p2p\project\models\ProjectInvest $_invest */
    protected $_invest;

    public function rules()
    {
        return [
            [['project_invest_id', 'min_money', 'transfer_money', 'discount_rate', 'counter_fee'], 'required'],
            [['min_money', 'counter_fee'], 'number', 'integerOnly' => true, 'min' => 0],
            ['transfer_money', 'number', 'integerOnly' => true, 'min' => $this->min_money, 'max' => $this->getMaxTransferMoney()]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'project_invest_id' => Yii::t('p2p_transfer', 'Project Invest ID'),
            'min_money' => Yii::t('p2p_transfer', 'Min Money'),
            'transfer_money' => Yii::t('p2p_transfer', 'Transfer Money'),
            'discount_rate' => Yii::t('p2p_transfer', 'Discount Rate'),
            'counter_fee' => Yii::t('p2p_transfer', 'Counter Fee'),
        ];
    }

    public function getMaxTransferMoney()
    {
        return $this->invest->invest_money;
    }

    public function getInvest()
    {
        if (!$this->_invest) {
            $projectInvestClass = Kiwi::getProjectInvestClass();
            $this->_invest = $projectInvestClass::findOne($this->project_invest_id);
            if (!$this->_invest || !$this->_invest->canTransfer() || !$this->_invest->project->canTransfer() ) {
                throw new Exception('Invalid Project Invest ID');
            }
        }

        return $this->_invest;
    }

    public function createTransfer()
    {
        $transferClass = Kiwi::getProjectInvestTransferApplyClass();
        $transfer = Kiwi::getProjectInvestTransferApply([
            'project_invest_id' => $this->invest->project_invest_id,
            'project_id' => $this->invest->project_id,
            'member_id' => Yii::$app->user->id,
            'min_money' => $this->min_money,
            'total_invest_money' => $this->transfer_money,
            'discount_rate' => $this->discount_rate,
            'status' => $transferClass::STATUS_PENDING,
        ]);

        return $transfer->save();
    }
}