<?php
/**
 * @link http://www.yincart.com/
 * @copyright Copyright (c) 2014 Yincart
 * @license http://www.yincart.com/license/
 */

use kiwi\Kiwi;

$intoPackageFormClass = Kiwi::getIntoPackageFormClass();
$outPackageFormClass = Kiwi::getOutPackageFormClass();

return [
    'events' => [
        $intoPackageFormClass . '::afterIntoPackage' => Yii::t('p2p_package', 'Into Package'),
        $outPackageFormClass . '::afterOutPackage' => Yii::t('p2p_package', 'Out Package'),
    ],

    'packageRecordType' => [
        '1' => Yii::t('p2p_package', 'Into money'),
        '2' => Yii::t('p2p_package', 'Out Money'),
    ]
];