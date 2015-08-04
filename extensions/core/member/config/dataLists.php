<?php
/**
 * @copyright Copyright (c) 2015 Kiwi
 */

use kiwi\Kiwi;

$newPasswordFormClass = Kiwi::getNewPasswordFormClass();
$bindEmailFormClass = Kiwi::getBindEmailFormClass();
$bindMobileFormClass = Kiwi::getBindMobileFormClass();
$userVerifyFormClass = Kiwi::getUserVerifyFormClass();

return [
    'events' => [
        'values' => [
            $newPasswordFormClass . '::afterResetPassword' => Yii::t('core_member', 'Change Password'),
            $bindEmailFormClass . '::afterSetEmailStatus' => Yii::t('core_member', 'Bind Email'),
            $bindMobileFormClass . '::afterSetMobileStatus' => Yii::t('core_member', 'Bind Mobile'),
            $userVerifyFormClass . '::afterSave' => Yii::t('core_member', 'User Verify'),
        ],
    ],
];