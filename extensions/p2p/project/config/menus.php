<?php

return [
    'project' => [
        'label' => Yii::t('p2p_project', 'Project'),
        'sort' => 2000,
        'url' => ['/p2p_project/project/index'],
        'items' => [
            'project' => [
                'label' => Yii::t('p2p_project', 'Project'),
                'sort' => 300,
                'items' => [
                    'project' => [
                        'label' => Yii::t('p2p_project', 'Project'),
                        'sort' => 100,
                        'url' => ['/p2p_project/project/index'],
                        'activeUrls' => [['/p2p_project/project/create'], ['/p2p_project/project/update']],
                    ],
                    'project_invest' => [
                        'label' => Yii::t('p2p_project', 'Project Invest'),
                        'sort' => 200,
                        'url' => ['/p2p_project/project-invest/index'],
                        'activeUrls' => [['/p2p_project/project-invest/create'], ['/p2p_project/project-invest/update']],
                    ],
                    'project_repayment' => [
                        'label' => Yii::t('p2p_project', 'Project Repayment'),
                        'sort' => 300,
                        'url' => ['/p2p_project/project-repayment/index'],
                        'activeUrls' => [['/p2p_project/project-repayment/create'], ['/p2p_project/project-repayment/update']],
                    ],
                ]
            ]
        ]
    ],
];

