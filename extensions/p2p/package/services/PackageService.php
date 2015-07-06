<?php
/**
 * @link http://www.yincart.com/
 * @copyright Copyright (c) 2014 Yincart
 * @license http://www.yincart.com/license/
 */

namespace p2p\package;


use kiwi\base\Service;
use kiwi\Kiwi;
use Yii;

/**
 * Class PackageService
 *
 * @package p2p\package
 * @author jeremy.zhou(gao_lujie@live.cn)
 */
class PackageService extends Service
{
    public function autoIntoPackage()
    {
        $memberStatisticClass = Kiwi::getMemberStatisticClass();
        $query = $memberStatisticClass::find()->where(['is_auto_into' => 1]);
        /** @var \p2p\package\models\MemberStatistic $memberStatistic */
        foreach ($query->each() as $memberStatistic) {
            $memberStatistic->autoIntoPackage();
        }
    }

    public function generateTodayInterests()
    {
        $memberStatisticClass = Kiwi::getMemberStatisticClass();
        $query = $memberStatisticClass::find();
        /** @var \p2p\package\models\MemberStatistic $memberStatistic */
        foreach ($query->each() as $memberStatistic) {
            $memberStatistic->createInterestRecord();
        }
    }
} 