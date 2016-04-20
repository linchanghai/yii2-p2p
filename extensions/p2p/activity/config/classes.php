<?php
/**
 * @link http://www.yincart.com/
 * @copyright Copyright (c) 2014 Yincart
 * @license http://www.yincart.com/license/
 */

return [
    'singleton' => [
        'ActivityService' => 'p2p\activity\services\ActivityService',
        'AnnualService' => 'p2p\activity\services\AnnualService',
        'BonusService' => 'p2p\activity\services\BonusService',
        'CashService' => 'p2p\activity\services\CashService',
    ],
    'class' => [
        'Activity' => 'p2p\activity\models\Activity',
        'ActivityRecord' => 'p2p\activity\models\ActivityRecord',
        'ExchangeRecord' => 'p2p\activity\models\ExchangeRecord',
        'ProductMap' => 'p2p\activity\models\ProductMap',
        'ProductMapSearch' => 'p2p\activity\searches\ProductMapSearch',
        'ActivitySearch' => 'p2p\activity\searches\ActivitySearch',
        'ExchangeRecordSearch' => 'p2p\activity\searches\ExchangeRecordSearch',
        'CouponAnnualRecordSearch' => 'p2p\activity\searches\CouponAnnualRecordSearch',
        'CouponBonusRecordSearch' => 'p2p\activity\searches\CouponBonusRecordSearch',
        'CouponCashRecordSearch' => 'p2p\activity\searches\CouponCashRecordSearch',
        'CouponAnnualRecord' => 'p2p\activity\models\CouponAnnualRecord',
        'CouponBonusRecord' => 'p2p\activity\models\CouponBonusRecord',
        'CouponCashRecord' => 'p2p\activity\models\CouponCashRecord',
        'MemberSignRecord' => 'p2p\activity\models\MemberSignRecord',
        'ProjectInvestEmpiricRecord' => 'p2p\activity\models\ProjectInvestEmpiricRecord',
    ],
];