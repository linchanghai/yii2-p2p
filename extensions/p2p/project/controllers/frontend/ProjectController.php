<?php
/**
 * Created by PhpStorm.
 * User: LCH
 * Date: 2015/6/29
 * Time: 9:26
 */

namespace p2p\project\controllers\frontend;


use kiwi\Kiwi;
use kiwi\web\Controller;
use yii\data\ActiveDataProvider;

class ProjectController extends Controller
{
    public function actionList()
    {
        $projectClass = Kiwi::getProjectClass();

        $dataProvider = new ActiveDataProvider([
            'query' => $projectClass::find(),
        ]);

        $dataProvider->prepare(true);

        return $this->render('list', [
            'projects' => $dataProvider->models,
        ]);
    }
}