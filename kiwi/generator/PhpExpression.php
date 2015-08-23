<?php
/**
 * @link http://www.yiikiwi.com/
 * @copyright Copyright (c) 2015 yiikiwi
 * @license http://www.yiikiwi.com/license/
 */

namespace kiwi\generator;


use yii\base\Object;

/**
 * Class PhpExpression
 * PhpExpression marks a string as a PHP expression.
 *
 * @package kiwi\generator
 * @author jeremy.zhou(gao_lujie@live.cn)
 */
class PhpExpression extends Object
{
    /**
     * @var string the PHP expression represented by this object
     */
    public $expression;


    /**
     * Constructor.
     * @param string $expression the PHP expression represented by this object
     * @param array $config additional configurations for this object
     */
    public function __construct($expression, $config = [])
    {
        $this->expression = $expression;
        parent::__construct($config);
    }

    /**
     * The PHP magic function converting an object into a string.
     * @return string the PHP expression.
     */
    public function __toString()
    {
        return $this->expression;
    }
}
