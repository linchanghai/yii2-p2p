<?php

namespace core\tree\controllers;

use kiwi\Kiwi;
use Yii;
use kiwi\web\Controller;

/**
 * TreeController implements the CRUD actions for Tree model.
 */
class TreeController extends Controller
{
    public function treeModelName()
    {
        return Kiwi::getTreeClass();
    }

    public function actions() {
        return [
            'nodeChildren' => [
                'class' => 'gilek\gtreetable\actions\NodeChildrenAction',
                'treeModelName' => $this->treeModelName(),
            ],
            'nodeCreate' => [
                'class' => 'gilek\gtreetable\actions\NodeCreateAction',
                'treeModelName' => $this->treeModelName(),
            ],
            'nodeUpdate' => [
                'class' => 'gilek\gtreetable\actions\NodeUpdateAction',
                'treeModelName' => $this->treeModelName(),
            ],
            'nodeDelete' => [
                'class' => 'gilek\gtreetable\actions\NodeDeleteAction',
                'treeModelName' => $this->treeModelName(),
            ],
            'nodeMove' => [
                'class' => 'gilek\gtreetable\actions\NodeMoveAction',
                'treeModelName' => $this->treeModelName(),
            ],
        ];
    }

    public function actionIndex() {
        return $this->render('index');
    }
}
