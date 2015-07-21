<?php
/**
 * @link http://www.yiikiwi.com/
 * @copyright Copyright (c) 2015 yiikiwi
 * @license http://www.yiikiwi.com/license/
 */

namespace p2p\activity\services;


use kiwi\base\Service;
use kiwi\Kiwi;
use Yii;
use yii\base\Event;
use yii\base\Exception;

class BonusService extends Service
{
    public function attachEvents()
    {
        Event::on(Kiwi::getInvestFormClass(), 'beforeInvest', [$this, 'changeInvestMoney']);
        Event::on(Kiwi::getInvestFormClass(), 'afterInvest', [$this, 'useBonus']);
    }

    /**
     * @param \yii\base\ModelEvent $event
     */
    public function changeInvestMoney($event)
    {
        /** @var \p2p\project\forms\InvestForm $investForm */
        $investForm = $event->sender;
        if ($investForm->bonusMoney) {
            $investForm->invest->actual_invest_money -= $investForm->bonusMoney;
        }
    }

    /**
     * @param \yii\base\ModelEvent $event
     * @throws Exception
     */
    public function useBonus($event)
    {
        /** @var \p2p\project\forms\InvestForm $investForm */
        $investForm = $event->sender;
        if (!$investForm->bonusMoney) {
            return;
        }

        $bonusRecord = Kiwi::getCouponBonusRecord([
            'member_id' => Yii::$app->user->id,
            'project_id' => $investForm->project->project_id,
            'project_invest_id' => $investForm->invest->project_invest_id,
            'discount_money' => $investForm->bonusMoney,
        ]);

        if (!$bonusRecord->save()) {
            throw new Exception('Save Bonus Record Error!');
        }
    }
} 