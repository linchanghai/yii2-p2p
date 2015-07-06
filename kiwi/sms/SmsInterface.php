<?php
/**
 * @author Lujie.Zhou(lujie.zhou@jago-ag.cn) 
 * @Date 6/6/2015
 * @Time 1:08 PM
 */

namespace kiwi\sms;

/**
 * Interface SmsInterface
 * @package kiwi\sms
 * @author Lujie.Zhou(lujie.zhou@jago-ag.cn)
 */
interface SmsInterface
{
    /**
     * Sends the given sms message.
     * @param string $message sms message instance to be sent
     * @param string $phone the phone number the message send to
     * @return boolean whether the message has been sent successfully
     */
    public function send($message, $phone);
}