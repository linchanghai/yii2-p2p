<?php
/**
 * @author Lujie.Zhou(lujie.zhou@jago-ag.cn) 
 * @Date 6/17/2015
 * @Time 9:11 PM
 */

namespace kiwi\payment;


interface PaymentInterface
{
    /**
     * @return string
     */
    public function generateId();

    /**
     * @param float $money
     */
    public function pay($money);

    /**
     * @param $data
     * @return boolean true if the payment is success
     */
    public function callback($data);
}