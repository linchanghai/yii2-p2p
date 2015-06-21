<?php
/**
 * @link http://www.yincart.com/
 * @copyright Copyright (c) 2014 Yincart
 * @license http://www.yincart.com/license/
 */

namespace core\member\models;

use kiwi\Kiwi;

/**
 * Class MemberTrait
 *
 * @property Member $member
 * @property MemberBank $memberBank
 * @property MemberStatus $memberStatus
 * @property MemberStatistic $memberStatistic
 *
 * @package core\member\models
 * @author jeremy.zhou(gao_lujie@live.cn)
 */
trait MemberTrait
{
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMember()
    {
        return $this->hasOne(Kiwi::getMemberClass(), ['member_id' => 'member_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMemberBank()
    {
        return $this->hasOne(Kiwi::getMemberBankClass(), ['member_id' => 'member_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMemberStatus()
    {
        return $this->hasOne(Kiwi::getMemberStatusClass(), ['member_id' => 'member_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMemberStatistic()
    {
        return $this->hasOne(Kiwi::getMemberStatisticClass(), ['member_id' => 'member_id']);
    }
} 