<?php
/**
 * @link http://www.yiikiwi.com/
 * @copyright Copyright (c) 2015 yiikiwi
 * @license http://www.yiikiwi.com/license/
 */

namespace core\system;

use kiwi\helpers\ArrayHelper;
use kiwi\Kiwi;
use yii\base\BootstrapInterface;

class Bootstrap implements BootstrapInterface
{
    public function bootstrap($app)
    {
        $this->sortConfig();
        $this->addUrlRules($app);
    }

    /**
     * @param \yii\web\Application $app the application currently running
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
} 