<?php

return [
    'project' => [
        'label' => Yii::t('p2p_project', 'Project'),
        'sort' => 2000,
        'url' => ['/p2p_project/project/index'],
        'items' => [
            'project' => [
                'label' => Yii::t('p2p_project', 'Project'),
                'sort' => 100,
                'items' => [
                    'project' => [
                        'label' => Yii::t('p2p_project', 'Project'),
                        'sort' => 100,
                        'url' => ['/p2p_project/project/index'],
                        'activeUrls' => [['/p2p_project/project/create'], ['/p2p_project/project/update'], ['/p2p_project/project/view']],
                    ],
                    'project_repaying' => [
                        'label' => Yii::t('p2p_project', 'Project Repaying'),
                        'sort' => 203,
                        'url' => ['/p2p_project/project-repaying/index'],
                        'activeUrls' => [['/p2p_project/project-repaying/update']],
                    ],
                    'project_end' => [
                        'label' => Yii::t('p2p_project', 'Project End'),
                        'sort' => 204,
                        'url' => ['/p2p_project/project-end/index'],
                        'activeUrls' => [['/p2p_project/project-end/update']],
                    ],
                ]
            ],
            'check' => [
                'label' => Yii::t('p2p_project', 'Project Check'),
                'sort' => 200,
                'items' => [
                    'project_check' => [
                        'label' => Yii::t('p2p_project', 'Project Pending'),
                        'sort' => 200,
                        'url' => ['/p2p_project/project-check/index'],
                        'activeUrls' => [['/p2p_project/project-check/update'], ['/p2p_project/project-check/view']],
                    ],
                    'project_passed' => [
                        'label' => Yii::t('p2p_project', 'Project Passed'),
                        'sort' => 201,
                        'url' => ['/p2p_project/project-passed/index'],
                        'activeUrls' => [['/p2p_project/project-passed/update']],
                    ],
                    'project_failed' => [
                        'label' => Yii::t('p2p_project', 'Project Failed'),
                        'sort' => 202,
                        'url' => ['/p2p_project/project-failed/index'],
                        'activeUrls' => [['/p2p_project/project-failed/update']],
                    ],
                ]
            ],
            'record' => [
                'label' => Yii::t('p2p_project', 'Project Record'),
                'sort' => 300,
                'items' => [
                    'project_invest' => [
                        'label' => Yii::t('p2p_project', 'Project Invest'),
                        'sort' => 300,
                        'url' => ['/p2p_project/project-invest/index'],
                        'activeUrls' => [['/p2p_project/project-invest/create'], ['/p2p_project/project-invest/update'], ['/p2p_project/project-invest/view']],
                    ],
                    'project_repayment' => [
                        'label' => Yii::t('p2p_project', 'Project Repayment'),
                        'sort' => 400,
                        'url' => ['/p2p_project/project-repayment/index'],
                        'activeUrls' => [['/p2p_project/project-repayment/create'], ['/p2p_project/project-repayment/update'], ['/p2p_project/project-repayment/view']],
                    ],
                ]
            ]
        ]
    ],
];

