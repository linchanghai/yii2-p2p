<?php
/**
 * @link http://www.yincart.com/
 * @copyright Copyright (c) 2014 Yincart
 * @license http://www.yincart.com/license/
 */

namespace p2p\project\controllers\frontend;


use kiwi\web\Controller;
use p2p\project\services\ProjectService;

class ProjectInvestController extends Controller
{
    public function actionPrepareInvest()
    {
        $p = new ProjectService();
        $invest = $p->getInvestInfo();
        json_encode($invest);
    }
} 