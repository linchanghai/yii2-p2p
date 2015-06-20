<?php
/**
 * @author Lujie.Zhou(lujie.zhou@jago-ag.cn)
 * @Date 6/10/2015
 * @Time 4:12 PM
 */

namespace core\auth;


use core\auth\filters\ActionAccessRule;
use kiwi\filters\AccessControl;
use kiwi\helpers\ArrayHelper;
use kiwi\Kiwi;
use Yii;
use yii\base\BootstrapInterface;

class Bootstrap implements BootstrapInterface
{
    public function bootstrap($app)
    {
        $this->sortPermissions();
        $this->accessControl();
        $this->filterMenu();
    }

    protected function accessControl()
    {
        $accessControl = [
            'class' => AccessControl::className(),
            'regex' => true,
            'except' => ['/site\/.*/'],
            'rules' => [
                // deny all POST requests
                [
                    'class' => ActionAccessRule::className(),
                    'allow' => true,
                    'checkAdmin' => [$this, 'checkAdmin']
                ],
            ],
        ];
        Yii::$app->attachBehavior('accessControl', $accessControl);
    }

    public function checkAdmin($user)
    {
        if ($user->identity->username == 'admin') {
            return true;
        }
        return false;
    }

    protected function filterMenu()
    {
        if (Yii::$app->user->isGuest) {
            return;
        }

        $filterMenu = function($menu) {
            if ($this->checkAdmin(Yii::$app->user)) {
                return true;
            }
            if (isset($menu['items'])) {
                return true;
            }
            if (isset($menu['url']) && $menu['url']) {
                $route = is_array($menu['url']) ? $menu['url'][0] : $menu['url'];
                if (preg_match('/site\/.*/', $route)) {
                    return true;
                }

                $keys = explode('/', trim($route, '/'));
                if (count($keys) == 2) {
                    array_unshift($keys, Yii::$app->id);
                }
                $permissionKey = implode('_', $keys);
                $formatKey = lcfirst(implode('', array_map(function ($k) {
                    return ucfirst($k);
                }, explode('-', $permissionKey))));
                return Yii::$app->user->can($formatKey);
            }
            return false;
        };

        $menus = Kiwi::getConfiguration()->menus;
        $menus = ArrayHelper::filter($menus, 'items', $filterMenu);
        Kiwi::getConfiguration()->menus = $menus;
    }

    protected function sortPermissions()
    {
        $permissions = Kiwi::getConfiguration()->permissions;
        $permissions = ArrayHelper::sortByKey($permissions, ['groups', 'permissions']);
        Kiwi::getConfiguration()->permissions = $permissions;
    }
}