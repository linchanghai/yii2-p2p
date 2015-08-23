<?php
/**
 * @author Lujie.Zhou(gao_lujie@live.cn)
 * @Date 10/17/2014
 * @Time 4:24 PM
 */

namespace core\auth\filters;


use kiwi\filters\AccessRule;
use Yii;
use yii\base\Application;

/**
 * Class ActionAccessRule
 *
 * public function behaviors()
 * {
 *     return [
 *         'access' => [
 *             'class' => \kiwi\filters\AccessControl::className(),
 *             'only' => ['create', 'update'],
 *             'rules' => [
 *                 // deny all POST requests
 *                 [
 *                     'class' => '\core\auth\filters\ActionAccessRule'
 *                     'allow' => true,
 *                     'verbs' => ['POST']
 *                 ],
 *                 // allow authenticated users
 *                 [
 *                     'class' => '\core\auth\filters\ActionAccessRule'
 *                     'allow' => true,
 *                     'roles' => ['@'],
 *                 ],
 *                 // everything else is denied
 *             ],
 *         ],
 *     ];
 * }
 *
 * @package core\auth\filters
 * @author Lujie.Zhou(gao_lujie@live.cn)
 */
class ActionAccessRule extends AccessRule
{
    public $params = [];

    public $checkAdmin;

    public function allows($action, $user, $request)
    {
        if ($this->matchActionAccess($action, $user, $request)) {
            return parent::allows($action, $user, $request);
        }
        return null;
    }

    /**
     * check the permission, if we rewrite and controller, the controller id and module id is not changed
     * @param \yii\base\Action $action
     * @param \yii\web\User $user
     * @param \yii\web\Request $request
     * @return bool
     */
    public function matchActionAccess($action, $user, $request)
    {
        if ($user->getIsGuest()) {
            return false;
        }

        if ($this->isAdmin($user)) {
            return true;
        }

        if ($action->controller->module instanceof Application) {
            $keys = [Yii::$app->id, $action->controller->id, $action->id];
        } else {
            $keys = [$action->controller->module->id, $action->controller->id, $action->id];
        }

        $key = implode('_', $keys);
        $formatKey = lcfirst(implode('', array_map(function ($k) {
            return ucfirst($k);
        }, explode('-', $key))));
        return $user->can($formatKey, $this->params);
    }

    /**
     * @param \yii\web\User $user
     * @return bool
     */
    public function isAdmin($user)
    {
        if ($this->checkAdmin && (is_callable($this->checkAdmin))) {
           return call_user_func($this->checkAdmin, $user);
        }
        return false;
    }
} 