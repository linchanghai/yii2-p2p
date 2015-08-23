<?php
/**
 * @link http://www.yiikiwi.com/
 * @copyright Copyright (c) 2015 yiikiwi
 * @license http://www.yiikiwi.com/license/
 */

namespace p2p\activity\services;


use kiwi\base\Service;
use kiwi\Kiwi;
use yii\base\Event;

class ActivityService extends Service
{

    public function attachActivities()
    {
        /** @var \p2p\activity\models\Activity[] $activities */
        $activities = Kiwi::getActivity()->find()->all();
        foreach ($activities as $activity) {
            $event = $activity->getActivityEvent();
            if ($event && is_array($event)) {
                Event::on($event[0], $event[1], [$this, 'saveActivityRecord'], $activity);
            }
        }
    }

    public function saveActivityRecord($event)
    {
        /** @var \p2p\activity\models\Activity $activity */
        $activity = $event->data;
        return $activity->saveRecord();
    }
} 