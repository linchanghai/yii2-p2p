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
 * Class OutPackageForm
 * @package p2p\package\forms
 * @author jeremy.zhou(gao_lujie@live.cn)
 */
class OutPackageForm extends Model
{
    public $outMoney;

    public function rules()
    {
        /** @var \core\member\models\Member $member */
        $member = Yii::$app->user->identity;
        $packageMoney = $member->memberStatistic->package_money;
        return [
            ['outMoney', 'number', 'min' => 1, 'max' => $packageMoney, 'integerOnly' => true,
                'message' => Yii::t('p2p_package', 'Out package money must be int'),
                'tooSmall' => Yii::t('p2p_package', 'Out package money must more than zero'),
                'tooBig' => Yii::t('p2p_package', 'Out package money must no more than package money'),
            ],
        ];
    }

    public function attributeLabels()
    {
        return [
            'outMoney' => Yii::t('p2p_package', 'Out Money'),
        ];
    }

    public function outPackage()
    {
        if (!$this->validate()) {
            return false;
        }

        $packageRecord = Kiwi::getPackageRecord();
        $packageRecord->type = $packageRecord::TYPE_OUT;
        $packageRecord->exchange_cash = $this->outMoney;
        $packageRecord->member_id = Yii::$app->user->id;
        if (!$packageRecord->save()) {
            $this->addError('outMoney', Json::encode($packageRecord->getErrors()));
            return false;
        }
        return true;
    }
} 