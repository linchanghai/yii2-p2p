<?php
/**
 * Created by PhpStorm.
 * User: LCH
 * Date: 2015/6/29
 * Time: 9:26
 */

namespace p2p\project\controllers\frontend;


use kiwi\web\Controller;

class ProjectController extends Controller {
    public function actionList()
    {
        return $this->render('list');
    }
}