<?php

return [
    'singleton' => [
    ],
    'class' => [
        //models
        'Project' => 'p2p\project\models\Project',
        'ProjectDetails' => 'p2p\project\models\ProjectDetails',
        'ProjectInvest' => 'p2p\project\models\ProjectInvest',
        'ProjectLegalOpinion' => 'p2p\project\models\ProjectLegalOpinion',
        'ProjectMaterial' => 'p2p\project\models\ProjectMaterial',
        'ProjectRepayment' => 'p2p\project\models\ProjectRepayment',

        //searches
        'ProjectSearch' => 'p2p\project\searches\ProjectSearch',
        'ProjectInvestSearch' => 'p2p\project\searches\ProjectInvestSearch',
        'ProjectRepaymentSearch' => 'p2p\project\searches\ProjectRepaymentSearch',

        //forms
        'ProjectInvestPrepareForm' => 'p2p\project\forms\ProjectInvestPrepareForm',
        'ProjectInvestForm' => 'p2p\project\forms\ProjectInvestForm',
        'InvestForm' => 'p2p\project\forms\InvestForm',

        //helpers
        'InterestHelper' => 'p2p\project\helpers\InterestHelper',
    ],
];
