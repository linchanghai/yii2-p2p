<?php
/**
 * Created by PhpStorm.
 * User: LCH
 * Date: 2015/6/27
 * Time: 10:53
 */

use kiwi\Kiwi;

$projectClass = Kiwi::getProjectClass();
$investFormClass = Kiwi::getInvestFormClass();

return [
    'events' => [
        'values' => [
            $investFormClass . 'afterInvest' => Yii::t('p2p_project', 'Invest'),
        ],
    ],

    'projectType' => [
        'values' => [
            $projectClass::TYPE_NORMAL => Yii::t('p2p_project', 'Normal Project'),
            $projectClass::TYPE_TRANSFER => Yii::t('p2p_project', 'Transfer Project'),
            $projectClass::TYPE_NOVICE => Yii::t('p2p_project', 'Novice Project'),
        ]
    ],

    'projectStatus' => [
        'values' => [
            $projectClass::STATUS_PENDING => Yii::t('p2p_project', 'Pending Check'),
            $projectClass::STATUS_INVESTING => Yii::t('p2p_project', 'Passed Check'),
            $projectClass::STATUS_FAILED => Yii::t('p2p_project', 'Failed Check'),
            $projectClass::STATUS_REPAYMENT => Yii::t('p2p_project', 'Repaying Project'),
            $projectClass::STATUS_END => Yii::t('p2p_project', 'Project End'),
        ]
    ],

    'projectCheckStatus' => [
        'values' => [
            $projectClass::STATUS_PENDING => Yii::t('p2p_project', 'Pending Check'),
            $projectClass::STATUS_INVESTING => Yii::t('p2p_project', 'Passed Check'),
            $projectClass::STATUS_FAILED => Yii::t('p2p_project', 'Failed Check'),
        ]
    ],

    'projectRepaymentType' => [
        'values' => [
            $projectClass::REPAYMENT_TYPE_MONTHLY => Yii::t('p2p_project', 'Monthly Interest Repayment'),
            $projectClass::REPAYMENT_TYPE_ONETIME => Yii::t('p2p_project', 'One-time principal and interest'),
            $projectClass::REPAYMENT_TYPE_EQUAL_MONTHLY => Yii::t('p2p_project', 'Equal monthly installments of principal and interest'),
        ]
    ]
];