<?php

namespace core\auth\controllers\backend;

use kiwi\filters\AccessControl;
use kiwi\Kiwi;
use Yii;
use yii\data\ActiveDataProvider;
use kiwi\web\Controller;
use yii\rbac\Item;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * RoleController implements the CRUD actions for Role model.
 */
class RoleController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all Role models.
     * @return mixed
     */
    public function actionIndex()
    {
        $roleClass = Kiwi::getAuthRoleClass();
        $dataProvider = new ActiveDataProvider([
            'query' => $roleClass::find()
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Creates a new Role model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = Kiwi::getRoleModel();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Role model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $authManager = Yii::$app->getAuthManager();
        $role = $authManager->getRole($id);
        $model = Kiwi::getRoleModel(['role' => $role]);
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        }
        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Role model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $authManager = Yii::$app->getAuthManager();
        $role = $authManager->getRole($id);
        if ($role) {
            $authManager->remove($role);
        }

        return $this->redirect(['index']);
    }
}
