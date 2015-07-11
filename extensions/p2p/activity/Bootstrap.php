<?php
/**
 * @link http://www.yincart.com/
 * @copyright Copyright (c) 2014 Yincart
 * @license http://www.yincart.com/license/
 */

namespace p2p\activity;


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
        $activityModels = Kiwi::getActivity()->find()->all();
        foreach ($activityModels as $activityModel) {
            $events = $activityModel->getActivityEvent();
            if (is_array($events)) {
                Event::on($events[0], $events[1], [$this, 'activity'], $activityModel);
            }
        }
    }

    public function activity($event)
    {
        $registerForm = $event->sender;
        $activityModel = $event->data;
        if ($activityModel->activity_send_type == $activityModel::SEND_TYPE_POINTS) {

            $memberStatisticModel = $registerForm->user->memberStatistic;
            $memberStatisticModel->points += $activityModel->activity_send_value;
            if (!$memberStatisticModel->save()) {
                throw new Exception('add points fail');
            }
        } else {
            $memberCoupon = Kiwi::getMemberCoupon([
                'member_id' => $registerForm->user->id,
                'type' => $activityModel->activity_send_type,
                'value' => $activityModel->activity_send_value,
                'expire_date' => $activityModel->vaild_date,
                'status' => 1,
            ]);
            if (!$memberCoupon->save()) {
                throw new Exception('add coupon fail');
            }
        }

        if (!$activityRecordModel = Kiwi::getActivityRecord([
            'member_id' => $registerForm->user->id,
            'activity_id' => $activityModel->activity_id
        ])->save()
        ) {
            throw new Exception('add record fail');
        };
    }
} 