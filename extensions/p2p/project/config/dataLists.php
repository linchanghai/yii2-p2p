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
            Project::PROJECT_TYPE_NORMAL => Yii::t('p2p_project', 'Normal Project'),
            Project::PROJECT_TYPE_TRANSFER => Yii::t('p2p_project', 'Transfer Project'),
        ]
    ],

    'projectStatus' => [
        'values' => [
            Project::PROJECT_STATUS_PENDING => Yii::t('p2p_project', 'Pending Check'),
            Project::PROJECT_STATUS_PASSED => Yii::t('p2p_project', 'Passed Check'),
            Project::PROJECT_STATUS_FAIlED => Yii::t('p2p_project', 'Failed Check'),
        ]
    ]
];