<?php
/**
 * @link http://www.yincart.com/
 * @copyright Copyright (c) 2014 Yincart
 * @license http://www.yincart.com/license/
 */

namespace p2p\package\forms;

use kiwi\base\Model;
use kiwi\Kiwi;
use Yii;
use yii\helpers\Json;

/**
 * Class IntoPackageForm
 * @package p2p\package\forms
 * @author jeremy.zhou(gao_lujie@live.cn)
 */
class IntoPackageForm extends Model
{
    public $intoMoney;

    public function rules()
    {
        /** @var \core\member\models\Member $member */
        $member = Yii::$app->user->identity;
        $accountMoney = $member->memberStatistic->account_money;
        return [
            ['intoMoney', 'required'],
            ['intoMoney', 'number', 'min' => 1, 'max' => $accountMoney, 'integerOnly' => true,
                'message' => Yii::t('p2p_package', 'Into package money must be int'),
                'tooSmall' => Yii::t('p2p_package', 'Into package money must more than zero'),
                'tooBig' => Yii::t('p2p_package', 'Into package money must no more than account money'),
            ],
        ];
    }

    public function attributeLabels()
    {
        return [
            'intoMoney' => Yii::t('p2p_package', 'Into money'),
        ];
    }

    public function intoPackage()
    {
        if (!$this->validate()) {
            return false;
        }

        $packageRecord = Kiwi::getPackageRecord();
        $packageRecord->type = $packageRecord::TYPE_INTO;
        $packageRecord->exchange_cash = $this->intoMoney;
        $packageRecord->member_id = Yii::$app->user->id;
        if (!$packageRecord->save()) {
            $this->addError('intoMoney', Json::encode($packageRecord->getErrors()));
            return false;
        }
        return true;
    }
} 