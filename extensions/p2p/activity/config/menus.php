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
                    'project_invest' => [
                        'label' => Yii::t('p2p_activity', 'Project Invest'),
                        'sort' => 300,
                        'url' => ['/p2p_activity/project-invest/index'],
                        'activeUrls' => [['/p2p_activity/project-invest/create'], ['/p2p_activity/project-invest/update']],
                    ],
                    'project_invest_point_record' => [
                        'label' => Yii::t('p2p_activity', 'Project Invest Point Record'),
                        'sort' => 400,
                        'url' => ['/p2p_activity/project-invest-point-record/index'],
                        'activeUrls' => [['/p2p_activity/project-invest-point-record/create'], ['/p2p_activity/project-invest-point-record/update']],
                    ],
                    'project_repayment' => [
                        'label' => Yii::t('p2p_activity', 'Project Repayment'),
                        'sort' => 700,
                        'url' => ['/p2p_activity/project-repayment/index'],
                        'activeUrls' => [['/p2p_activity/project-repayment/create'], ['/p2p_activity/project-repayment/update']],
                    ],
                ]
            ]
        ]
    ],
];

