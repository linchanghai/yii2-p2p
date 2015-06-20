<?php

return [
    'activity' => [
        'label' => Yii::t('app', 'Activity'),
        'sort' => 2000,
        'url' => ['p2p_activity'],
        'items' => [
            'project' => [
                'label' => Yii::t('p2p_activity', 'Project'),
                'sort' => 100,
                'url' => ['/p2p_activity/project/index'],
            ],
            'project_details' => [
                'label' => Yii::t('p2p_activity', 'Project Details'),
                'sort' => 200,
                'url' => ['/p2p_activity/project-details/index'],
            ],
            'project_invest_point_record' => [
                'label' => Yii::t('p2p_activity', 'Project Invest Point Record'),
                'sort' => 300,
                'url' => ['/p2p_activity/project-invest-point-record/index'],
            ],
            'project_invest_record' => [
                'label' => Yii::t('p2p_activity', 'Project Invest Record'),
                'sort' => 400,
                'url' => ['/p2p_activity/project-invest-record/index'],
            ],
            'project_legal_opinion' => [
                'label' => Yii::t('p2p_activity', 'Project Legal Opinion'),
                'sort' => 500,
                'url' => ['/p2p_activity/project-legal-opinion/index'],
            ],
            'project_material' => [
                'label' => Yii::t('p2p_activity', 'Project Material'),
                'sort' => 600,
                'url' => ['/p2p_activity/project-material/index'],
            ],
            'project_repayment_record' => [
                'label' => Yii::t('p2p_activity', 'Project Repayment Record'),
                'sort' => 700,
                'url' => ['/p2p_activity/project-repayment-record/index'],
            ],
        ]
    ],
];

