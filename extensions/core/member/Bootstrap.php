<?php
/**
 * @link http://www.yincart.com/
 * @copyright Copyright (c) 2014 Yincart
 * @license http://www.yincart.com/license/
 */

namespace core\member;


use kiwi\Kiwi;
use yii\base\BootstrapInterface;
use yii\base\Event;
use yii\base\Exception;

class Bootstrap implements BootstrapInterface
{
    public function bootstrap($app)
    {
        $this->attachEvents($app);
    }

    /**
     * @param \yii\base\Application $app
     */
    public function attachEvents($app)
    {
        if ($app->id == 'frontend') {
            $memberClass = Kiwi::getMemberClass();
            Event::on($memberClass, $memberClass::EVENT_AFTER_INSERT, [$this, 'createMemberRelations']);
        }
    }

    /**
     * @param \yii\base\ModelEvent $event
     * @throws Exception
     */
    public function createMemberRelations($event)
    {
        /** @var \core\member\models\Member $member */
        $member = $event->sender;

        $memberStatus = Kiwi::getMemberStatus();
        foreach ($memberStatus->attributes() as $attribute) {
            $memberStatus->$attribute = 0;
        }
        $memberStatus->member_id = $member->member_id;

        $memberStatistic = Kiwi::getMemberStatistic();
        foreach ($memberStatistic->attributes() as $attribute) {
            $memberStatistic->$attribute = 0;
        }
        $memberStatistic->member_id = $member->member_id;

        if (!$memberStatus->save(false) || !$memberStatistic->save(false)) {
            throw new Exception('Save member relation fail');
        }
    }
} 