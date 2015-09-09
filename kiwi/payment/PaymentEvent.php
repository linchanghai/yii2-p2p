<?php
/**
 * @author Lujie.Zhou(lujie.zhou@jago-ag.cn) 
 * @Date 6/17/2015
 * @Time 9:16 PM
 */

namespace kiwi\payment;


use yii\base\Event;

/**
 * Class PaymentEvent
 *
 * @property BasePayment $sender
 *
 * @package kiwi\payment
 * @author Lujie.Zhou(lujie.zhou@jago-ag.cn)
 */
class PaymentEvent extends Event
{
    public $transactionId;

    /**
     * @var float the pay money
     */
    public $money;

    /**
     * @var array the payment return callback post data
     * */
    public $callbackData;

    /**
     * @var bool if the payment is successful
     */
    public $isSuccessful;

    /**
     * @var bool if the payment course some errors
     */
    public $isError;

    /**
     * @var bool if the payment is continue
     */
    public $isValid = true;
}