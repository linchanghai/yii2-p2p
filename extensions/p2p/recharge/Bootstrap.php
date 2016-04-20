<?php
/**
 * @link http://www.yincart.com/
 * @copyright Copyright (c) 2014 Yincart
 * @license http://www.yincart.com/license/
 */

namespace p2p\recharge;


use kiwi\Kiwi;
use kiwi\payment\Payment;
use kiwi\payment\PaymentEvent;
use yii\base\BootstrapInterface;
use yii\base\Exception;
use yii\helpers\Json;

class Bootstrap implements BootstrapInterface
{
    public function bootstrap($app)
    {
        Kiwi::getRechargeService()->attachEvents();
    }
} 