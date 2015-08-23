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
     * @param string $method
     * @param float $money
     */
    public function pay($method, $money);

    /**
     * @param string $method
     * @param array $data
     * @return boolean true if the payment is success
     */
    public function callback($method, $data);
}