<?php
/**
 * @link http://www.yincart.com/
 * @copyright Copyright (c) 2014 Yincart
 * @license http://www.yincart.com/license/
 */

return [
    'singleton' => [
        'RechargeService' => 'p2p\recharge\services\RechargeService',
    ],
    'class' => [
        'RechargeRecord' => 'p2p\recharge\models\RechargeRecord',

        'RechargeForm' => 'p2p\recharge\forms\RechargeForm',

        'RechargeRecordSearch' => 'p2p\recharge\searches\RechargeRecordSearch',
    ],
];