<?php
/**
 * @copyright Copyright (c) 2015 Kiwi
 */

use kiwi\Kiwi;

$loginFormClass = Kiwi::getLoginFormClass();
$signupFormClass = Kiwi::getSignupFormClass();

return [
    'events' => [
        'values' => [
            $signupFormClass . '::afterSignup' => Yii::t('core_user', 'Signup'),
            $loginFormClass . '::afterLogin' => Yii::t('core_user', 'Login'),
        ]
    ],
];