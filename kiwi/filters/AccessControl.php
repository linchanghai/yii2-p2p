<?php
/**
 * @link http://www.yiikiwi.com/
 * @copyright Copyright (c) 2015 yiikiwi
 * @license http://www.yiikiwi.com/license/
 */

namespace kiwi\filters;

use yii\base\Module;

/**
 * Class AccessControl
 * @package kiwi\filters
 * @author jeremy.zhou(gao_lujie@live.cn)
 */
class AccessControl extends \yii\filters\AccessControl
{
    /** @var bool check the action is active by regex */
    public $regex = false;

    /** @var bool if action not in only and except, the default return */
    public $default = true;

    /**
     * @inheritdoc
     */
    protected function isActive($action)
    {
        if (!$this->regex) {
            return parent::isActive($action);
        }

        if ($this->owner instanceof Module) {
            // convert action uniqueId into an ID relative to the module
            $mid = $this->owner->getUniqueId();
            $id = $action->getUniqueId();
            if ($mid !== '' && strpos($id, $mid) === 0) {
                $id = substr($id, strlen($mid) + 1);
            }
        } else {
            $id = $action->id;
        }

        if ($this->only) {
            if (in_array($id, $this->only, true)) {
                return true;
            }
            foreach ($this->only as $only) {
                if (substr($only, 0, 1) == '/' && substr($only, -1) == '/') {
                    if (preg_match($only, $id)) {
                        return true;
                    }
                }
            }
        }

        if ($this->except) {
            if (in_array($id, $this->except, true)) {
                return false;
            }
            foreach ($this->except as $except) {
                if (substr($except, 0, 1) == '/' && substr($except, -1) == '/') {
                    if (preg_match($except, $id)) {
                        return false;
                    }
                }
            }
        }

        return $this->default;
    }
} 