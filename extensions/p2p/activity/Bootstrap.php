<?php
/**
 * @link http://www.yincart.com/
 * @copyright Copyright (c) 2014 Yincart
 * @license http://www.yincart.com/license/
 */

namespace p2p\activity;

use kiwi\Kiwi;
use yii\base\BootstrapInterface;

class Bootstrap implements BootstrapInterface
{
    public function bootstrap($app)
    {
        Kiwi::getActivityService()->attachActivities();
        Kiwi::getAnnualService()->attachEvents();
        Kiwi::getBonusService()->attachEvents();
        Kiwi::getCashService()->attachEvents();
    }
} 