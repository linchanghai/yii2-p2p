<?php
/**
 * @link http://www.yincart.com/
 * @copyright Copyright (c) 2014 Yincart
 * @license http://www.yincart.com/license/
 */

namespace core\notification\services;


use kiwi\base\Service;
use kiwi\Kiwi;
use Yii;
use yii\base\Event;

/**
 * Class NotificationServices
 * @package core\notification\services
 * @author jeremy.zhou(gao_lujie@live.cn)
 */
class NotificationServices extends Service
{
    /**
     * attach event to trigger send notification
     */
    public function attachNotifications()
    {
        $notificationTemplateClass = Kiwi::getNotificationTemplateClass();
        $notificationTemplates = $notificationTemplateClass::findAll(['active' => 1]);
        foreach ($notificationTemplates as $notificationTemplate) {
            list($className, $eventName) = $notificationTemplate->getEventInfo();
            Event::on($className, $eventName, [$this, 'sendNotification'], $notificationTemplate);
        }
    }

    /**
     * @param \yii\base\Event $event
     */
    public function sendNotification($event)
    {
        /** @var \core\notification\models\NotificationTemplate  $notificationTemplate */
        $notificationTemplate = $event->data;
        $data = ['event' => $event, 'sender' => $event->sender, 'data' => $event->data, 'user' => Yii::$app->user->identity];
        $title = $notificationTemplate->title;
        $message = $notificationTemplate->getMessage($data);
        $receiver = $notificationTemplate->getReceiver($data);
        $sendMethod = 'send' . $notificationTemplate->type;
        if ($receiver && method_exists($this, $sendMethod)) {
            if ($this->$sendMethod($receiver, $message, $title)) {
                Yii::info("Send {$notificationTemplate->type} notification {$title} to {$receiver} Success", __METHOD__);
            } else {
                Yii::Warning("Send {$notificationTemplate->type} notification {$title} to {$receiver} Fail", __METHOD__);
            }
        }
    }

    /**
     * @param $phone
     * @param $message
     * @return bool
     */
    public function sendSms($phone, $message)
    {
        return Yii::$app->sms->send($message, $phone);
    }

    /**
     * @param $to
     * @param $content
     * @param $title
     * @return bool
     */
    public function sendMail($to, $content, $title)
    {
        return Yii::$app->mailer->compose('notificationTemplate', ['content' => $content])
            ->setSubject($title)
            ->setFrom([Yii::$app->params['supportEmail'] => Yii::$app->name . ' robot'])
            ->setTo($to)
            ->send();
    }

    /**
     * @param $to
     * @param $content
     * @param $title
     * @return bool
     */
    public function sendMessage($to, $content, $title)
    {
        return Yii::$app->message->compose()
            ->setContent($content)
            ->setTitle($title)
            ->setTo($to)
            ->send();
    }
} 