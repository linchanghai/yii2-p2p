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
 * @package p2p\project\forms
 * @author changhai.lin<1079140464@qq.com>
 */
class TransferForm extends Model
{
    const EVENT_BEFORE_TRANSFER = 'beforeTransfer';
    const EVENT_AFTER_TRANSFER = 'afterTransfer';

    public $project_invest_id;
    public $transfer_money;
    public $discount_rate;

    /** @var \p2p\project\models\ProjectInvest */
    protected $_invest;

    public function rules()
    {
        return [
            [['project_invest_id', 'transfer_money', 'discount_rate'], 'required'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'project_invest_id' => Yii::t('p2p_project', 'Invest Money'),
            'transfer_money' => Yii::t('p2p_project', 'Transfer Money'),
            'discount_rate' => Yii::t('p2p_project', 'Discount Rate'),
        ];
    }

    public function getMaxTransferMoney()
    {
        return $this->_invest->invest_money;
    }

    public function getInvest()
    {
        if (!$this->_invest) {
            $projectInvestClass = Kiwi::getProjectInvestClass();
            $this->_invest = $projectInvestClass::findOne($this->project_invest_id);
            if ($this->_invest) {
                throw new Exception('Invalid Project Invest ID');
            }
        }

        return $this->_invest;
    }
}