<?php
/**
 * @link http://www.yincart.com/
 * @copyright Copyright (c) 2014 Yincart
 * @license http://www.yincart.com/license/
 */

return [
    'class' => [
        'Member' => 'core\member\models\Member',
        'MemberBank' => 'core\member\models\MemberBank',
        'MemberStatus' => 'core\member\models\MemberStatus',
        'MemberStatistic' => 'core\member\models\MemberStatistic',
        'MemberCoupon' => 'core\member\models\MemberCoupon',
        'StatisticChangeRecord' => 'core\member\models\StatisticChangeRecord',

        'MemberSearch' => 'core\member\searches\MemberSearch',
        'StatisticChangeRecordSearch' => 'core\member\searches\StatisticChangeRecordSearch',

        'BindEmailForm' => 'core\member\forms\BindEmailForm',
        'BindMobileForm' => 'core\member\forms\BindMobileForm',
        'UserVerifyForm' => 'core\member\forms\UserVerifyForm',
        'NewPasswordForm' => 'core\member\forms\NewPasswordForm',
    ]
];