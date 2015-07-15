<?php
/**
 * @link http://www.yincart.com/
 * @copyright Copyright (c) 2014 Yincart
 * @license http://www.yincart.com/license/
 */

namespace p2p\withdraw;


use kiwi\Kiwi;
use yii\base\BootstrapInterface;
use yii\base\Event;
use Yii;

class Bootstrap implements BootstrapInterface
{
    public function bootstrap($app)
    {
        $this->attachEvents($app);
    }

    public function attachEvents($app)
    {
        Event::on(Kiwi::getWithdrawFormClass(), 'beforeWithdraw', [$this, 'freezeMoney']);
    }

    public function freezeMoney($event)
    {
        /** @var \p2p\withdraw\forms\WithdrawForm $form */
        $form = $event->sender;

        $memberStatistic = Kiwi::getMemberStatistic();
        /** @var \core\member\models\MemberStatistic $memberStatistic */
        $memberStatistic = $memberStatistic::findOne(['member_id' => Yii::$app->user->id]);

        $memberStatistic->freezon_money = $form->withdrawMoney + $form->withdrawFee;
        $memberStatistic->account_money -= $memberStatistic->freezon_money;
        $memberStatistic->save();
    }
} 