<?php
/**
 * @link http://www.yiikiwi.com/
 * @copyright Copyright (c) 2015 yiikiwi
 * @license http://www.yiikiwi.com/license/
 */

use kiwi\Kiwi;

return [
    'activityTypes' => [
        'label' => Yii::t('p2p_activity', 'Activity Type'),
        'values' => [
            1 => Yii::t('p2p_activity','Signup'),
            2 => Yii::t('p2p_activity','Invest'),
        ],
    ],
    'activityTypeEvents' => [
        'label' => Yii::t('p2p_activity', 'Activity Type Event'),
        'values' => [
            1 => ['core\user\forms\SignupForm', 'afterSignup'],
            2 => ['p2p\project\forms\InvestForm', 'afterInvest'],
        ],
    ],
    'activitySendTypes' => [
        'label' => Yii::t('p2p_activity', 'Activity Type'),
        'values' => [
            1 => Yii::t('p2p_activity','Points'),
            2 => Yii::t('p2p_activity','Annual'),
            3 => Yii::t('p2p_activity','Bonus'),
            4 => Yii::t('p2p_activity','Cash'),
        ],
    ],
];