<?php

return [
    'activity' => [
        'label' => Yii::t('p2p_activity', 'Activity'),
        'sort' => 2000,
        'url' => ['/p2p_activity/project/index'],
        'items' => [
            'activity' => [
                'label' => Yii::t('p2p_activity', 'Activity'),
                'sort' => 300,
                'items' => [
                    'project' => [
                        'label' => Yii::t('p2p_activity', 'Project'),
                        'sort' => 100,
                        'url' => ['/p2p_activity/project/index'],
                        'activeUrls' => [['/p2p_activity/project/create'], ['/p2p_activity/project/update']],
                    ],
                    'project_details' => [
                        'label' => Yii::t('p2p_activity', 'Project Details'),
                        'sort' => 200,
                        'url' => ['/p2p_activity/project-details/index'],
                        'activeUrls' => [['/p2p_activity/project-details/create'], ['/p2p_activity/project-details/update']],
                    ],
                    'project_invest_point_record' => [
                        'label' => Yii::t('p2p_activity', 'Project Invest Point Record'),
                        'sort' => 300,
                        'url' => ['/p2p_activity/project-invest-point-record/index'],
                        'activeUrls' => [['/p2p_activity/project-invest-point-record/create'], ['/p2p_activity/project-invest-point-record/update']],
                    ],
                    'project_invest_record' => [
                        'label' => Yii::t('p2p_activity', 'Project Invest Record'),
                        'sort' => 400,
                        'url' => ['/p2p_activity/project-invest-record/index'],
                        'activeUrls' => [['/p2p_activity/project-invest-record/create'], ['/p2p_activity/project-invest-record/update']],
                    ],
                    'project_legal_opinion' => [
                        'label' => Yii::t('p2p_activity', 'Project Legal Opinion'),
                        'sort' => 500,
                        'url' => ['/p2p_activity/project-legal-opinion/index'],
                        'activeUrls' => [['/p2p_activity/project-legal-opinion/create'], ['/p2p_activity/project-legal-opinion/update']],
                    ],
                    'project_material' => [
                        'label' => Yii::t('p2p_activity', 'Project Material'),
                        'sort' => 600,
                        'url' => ['/p2p_activity/project-material/index'],
                        'activeUrls' => [['/p2p_activity/project-material/create'], ['/p2p_activity/project-material/update']],
                    ],
                    'project_repayment_record' => [
                        'label' => Yii::t('p2p_activity', 'Project Repayment Record'),
                        'sort' => 700,
                        'url' => ['/p2p_activity/project-repayment-record/index'],
                        'activeUrls' => [['/p2p_activity/project-repayment-record/create'], ['/p2p_activity/project-repayment-record/update']],
                    ],
                ]
            ]
        ]
    ],
];

