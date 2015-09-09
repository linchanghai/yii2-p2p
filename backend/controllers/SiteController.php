<?php
namespace backend\controllers;

use core\user\controllers\UserController;
use kiwi\generator\CodeGenerator;
use kiwi\Kiwi;
use Yii;

/**
 * Site controller
 */
class SiteController extends UserController
{
    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionTable()
    {
        $generator = new CodeGenerator();
        $generator->generateTables();
    }
}
