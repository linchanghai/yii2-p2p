<?php
/**
 * Created by PhpStorm.
 * Author: changhai.lin<1079140464@qq.com>
 * Date: 2015/8/3
 * Time: 10:19
 */

use p2p\transfer\models\ProjectInvestTransferApply;

return [
    'transferStatus' => [
        'values' => [
            ProjectInvestTransferApply::STATUS_PENDING => Yii::t('p2p_transfer', 'Pending Check'),
            ProjectInvestTransferApply::STATUS_TRANSFERING => Yii::t('p2p_transfer', 'Transfering'),
            ProjectInvestTransferApply::STATUS_FAILED => Yii::t('p2p_transfer', 'Failed Check'),
            ProjectInvestTransferApply::STATUS_REPAYMENT => Yii::t('p2p_transfer', 'Repayment'),
            ProjectInvestTransferApply::STATUS_END => Yii::t('p2p_transfer', 'Transfer End'),
        ]
    ]
];