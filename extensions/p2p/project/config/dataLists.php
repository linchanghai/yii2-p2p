<?php
/**
 * Created by PhpStorm.
 * User: LCH
 * Date: 2015/6/27
 * Time: 10:53
 */

use p2p\project\models\Project;

return [
    'projectType' => [
        'values' => [
            Project::TYPE_NORMAL => Yii::t('p2p_project', 'Normal Project'),
            Project::TYPE_TRANSFER => Yii::t('p2p_project', 'Transfer Project'),
            Project::TYPE_NOVICE => Yii::t('p2p_project', 'Novice Project'),
        ]
    ],

    'projectStatus' => [
        'values' => [
            Project::STATUS_PENDING => Yii::t('p2p_project', 'Pending Check'),
            Project::STATUS_INVESTING => Yii::t('p2p_project', 'Passed Check'),
            Project::STATUS_FAILED => Yii::t('p2p_project', 'Failed Check'),
            Project::STATUS_REPAYMENT => Yii::t('p2p_project', 'Repaying Project'),
            Project::STATUS_END => Yii::t('p2p_project', 'Project End'),
        ]
    ],

    'projectRepaymentType' => [
        'values' => [
            Project::REPAYMENT_TYPE_MONTHLY => Yii::t('p2p_project', 'Monthly Interest Repayment'),
            Project::REPAYMENT_TYPE_DISPOSABLE => Yii::t('p2p_project', 'Disposable Principal and Interest'),
            Project::REPAYMENT_TYPE_EQUAL_MONTHLY => Yii::t('p2p_project', 'Equal monthly installments of principal and interest'),
        ]
    ]
];