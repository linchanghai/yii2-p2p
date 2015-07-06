<?php
/**
 * @author Lujie.Zhou(lujie.zhou@jago-ag.cn) 
 * @Date 6/6/2015
 * @Time 1:14 PM
 */

namespace kiwi\sms;

use yii\base\Event;

/**
 * Class SmsEvent
 * @package kiwi\sms
 * @author Lujie.Zhou(lujie.zhou@jago-ag.cn)
 */
class SmsEvent extends Event
{
    /**
     * @var string the phone number send to
     */
    public $phone;
    /**
     * @var string the sms message being send.
     */
    public $message;
    /**
     * @var boolean if message was sent successfully.
     */
    public $isSuccessful;
    /**
     * @var boolean whether to continue sending sms. Event handlers of
     * [[\kiwi\sms\BaseSms::EVENT_BEFORE_SEND]] may set this property to decide whether
     * to continue send or not.
     */
    public $isValid = true;
}