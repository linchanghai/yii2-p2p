<?php
/**
 * @link http://www.yincart.com/
 * @copyright Copyright (c) 2014 Yincart
 * @license http://www.yincart.com/license/
 */

namespace p2p\project\services;


class ProjectService
{
    public function getInvestInfo($project, $money, $annual)
    {
        return $invest;
    }

    public function invest($project, $money, $annual, $bonus, $couponCash)
    {
        $invest = $this->getInvestInfo($project, $money, $annual);
        $invest->save();
//        foreach ($invest->repayments as $r) {
//            $r->save();
//        }

    }
} 