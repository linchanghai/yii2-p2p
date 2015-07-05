<?php
/**
 * @link http://www.yiikiwi.com/
 * @copyright Copyright (c) 2015 yiikiwi
 * @license http://www.yiikiwi.com/license/
 */

namespace kiwi\searchers;

/**
 * Class InlineSearcher
 * @package kiwi\searchers
 * @author jeremy.zhou(gao_lujie@live.cn)
 */
class InlineSearcher extends Searcher
{
    /**
     * @var string|\Closure an anonymous function or the name of a model class method that will be
     * called to perform the actual validation. The signature of the method should be like the following:
     *
     * ~~~
     * function foo($attribute, $params)
     * ~~~
     */
    public $method;
    /**
     * @var array additional parameters that are passed to the validation method
     */
    public $params;

    /**
     * @inheritdoc
     */
    public function searchAttribute($object, $attribute)
    {
        $method = $this->method;
        if (is_string($method)) {
            $method = [$object, $method];
        }
        call_user_func($method, $attribute, $this->params);
    }
}