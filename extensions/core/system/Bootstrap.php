<?php
/**
 * @link http://www.yiikiwi.com/
 * @copyright Copyright (c) 2015 yiikiwi
 * @license http://www.yiikiwi.com/license/
 */

namespace core\system;

use kiwi\helpers\ArrayHelper;
use kiwi\Kiwi;
use Yii;
use yii\base\BootstrapInterface;
use yii\base\Event;
use yii\web\Controller;

class Bootstrap implements BootstrapInterface
{
    public function bootstrap($app)
    {
        $this->sortConfig();
        $this->addUrlRules($app);
        $this->attachEvents($app);
    }

    /**
     * @param \yii\base\Application $app the application currently running
     * @inheritdoc
     */
    protected function addUrlRules($app)
    {
        $urlManager = $app->getUrlManager();
        $urlManager->enablePrettyUrl = true;
        $urlManager->addRules([['class' => Kiwi::getRewriteUrlRuleClass()]]);
    }

    protected function sortConfig()
    {
        $settings = Kiwi::getConfiguration()->settings;
        $settings = ArrayHelper::sortByKey($settings, ['groups', 'fields']);
        Kiwi::getConfiguration()->settings = $settings;

        $menus = Kiwi::getConfiguration()->menus;
        $menus = ArrayHelper::sortByKey($menus, 'items');
        Kiwi::getConfiguration()->menus = $menus;
    }

    /**
     * @param \yii\base\Application $app
     */
    protected function attachEvents($app)
    {
        $app->on(Controller::EVENT_BEFORE_ACTION, [$this, 'setActiveMenu']);
    }

    public function setActiveMenu()
    {
        $menus = Kiwi::getConfiguration()->menus;
        foreach ($menus as $key => $menu) {
            if ($this->isItemActive($menu)) {
                $menu['active'] = true;
            }
            if (isset($menu['items']) && is_array($menu['items'])) {
                foreach ($menu['items'] as $groupKey => $itemGroup) {
                    if ($this->isItemActive($itemGroup)) {
                        $itemGroup['active'] = true;
                        $menu['active'] = true;
                    }
                    if (isset($itemGroup['items']) && is_array($itemGroup['items'])) {
                        foreach ($itemGroup['items'] as $itemKey => $item) {
                            if ($this->isItemActive($item)) {
                                $item['active'] = true;
                                $itemGroup['active'] = true;
                                $menu['active'] = true;
                                $itemGroup['items'][$itemKey] = $item;
                            }
                        }
                    }
                    $menu['items'][$groupKey] = $itemGroup;
                }
            }
            $menus[$key] = $menu;
        }
        Kiwi::getConfiguration()->menus = $menus;
    }

    protected function isItemActive($item)
    {
        $urls = isset($item['activeUrls']) ? $item['activeUrls'] : [];
        if (isset($item['url'])) {
            $urls[] = $item['url'];
        }

        foreach ($urls as $url) {
            if (isset($url) && is_array($url) && isset($url[0])) {
                $route = $url[0];
                if ($route[0] !== '/' && Yii::$app->controller) {
                    $route = Yii::$app->controller->module->getUniqueId() . '/' . $route;
                }
                if (ltrim($route, '/') !== Yii::$app->controller->getRoute()) {
                    continue;
                }
                unset($url['#']);
                if (count($url) > 1) {
                    $params = $url;
                    unset($params[0]);
                    foreach ($params as $name => $value) {
                        if ($value !== null && Yii::$app->request->getQueryParam($name) != $value) {
                            continue;
                        }
                    }
                }
                return true;
            }
        }
        return false;
    }
} 