<?php
/**
 * @copyright Copyright (c) 2015 Kiwi
 */

namespace kiwi\base;
use yii\base\Model;

/**
 * Class ErrorTrait
 * @package kiwi\base
 * @author jeremy.zhou(gao_lujie@live.cn)
 */
trait ErrorTrait
{
    /**
     * @param null|array $attribute
     * @return string
     */
    public function getErrorsAsString($attribute = null)
    {
        /** @var $this ErrorTrait|Model */
        $errors = $this->getErrors($attribute);
        $errors = array_map(function($attr, $attrErrors) {
            /** @var $this ErrorTrait|Model */
            return $this->getAttributeLabel($attr) . ':' . implode(';', $attrErrors);
        }, array_keys($errors), $errors);
        return implode('.', $errors);
    }

    /**
     * @return string
     */
    public function getFirstErrorsAsString()
    {
        /** @var $this ErrorTrait|Model */
        $errors = $this->getFirstErrors();
        $errors = array_map(function($attr, $firstError) {
            /** @var $this ErrorTrait|Model */
            return $this->getAttributeLabel($attr) . ':' . $firstError;
        }, array_keys($errors), $errors);
        return implode('.', $errors);
    }
}