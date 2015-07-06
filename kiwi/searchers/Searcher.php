<?php
/**
 * @link http://www.yiikiwi.com/
 * @copyright Copyright (c) 2015 yiikiwi
 * @license http://www.yiikiwi.com/license/
 */

namespace kiwi\searchers;

use Yii;
use yii\base\Component;
use yii\base\NotSupportedException;

/**
 * Class Searcher
 * @package kiwi\searchers
 * @author jeremy.zhou(gao_lujie@live.cn)
 */
class Searcher extends Component
{
    /**
     * @var array list of built-in searchers (name => class or configuration)
     */
    public static $builtInSearchers = [
        'string' => 'kiwi\searchers\StringSearcher',
        'date' => 'kiwi\searchers\DateSearcher',
        'in' => 'kiwi\searchers\RangeSearcher',
        'number' => 'kiwi\searchers\NumberSearcher',
    ];

    /**
     * @var array|string attributes to be searched by this searcher. For multiple attributes,
     * please specify them as an array; for single attribute, you may use either a string or an array.
     */
    public $attributes = [];
    /**
     * @var array|string scenarios that the searcher can be applied to. For multiple scenarios,
     * please specify them as an array; for single scenario, you may use either a string or an array.
     */
    public $on = [];
    /**
     * @var array|string scenarios that the searcher should not be applied to. For multiple scenarios,
     * please specify them as an array; for single scenario, you may use either a string or an array.
     */
    public $except = [];

    public $searchFieldClass = 'kiwi\searchers\SearchField';

    public $display = true;

    /**
     * Creates a searcher object.
     * @param mixed $type the searcher type. This can be a built-in searcher name,
     * a method name of the model class, an anonymous function, or a searcher class name.
     * @param \yii\base\Model $object the data object to be searched.
     * @param array|string $attributes list of attributes to be searched. This can be either an array of
     * the attribute names or a string of comma-separated attribute names.
     * @param array $params initial values to be applied to the searcher properties
     * @return Searcher the searcher
     */
    public static function createSearcher($type, $object, $attributes, $params = [])
    {
        $params['attributes'] = $attributes;

        if ($type instanceof \Closure || $object->hasMethod($type)) {
            // method-based searcher
            $params['class'] = __NAMESPACE__ . '\InlineSearcher';
            $params['method'] = $type;
        } else {
            if (isset(static::$builtInSearchers[$type])) {
                $type = static::$builtInSearchers[$type];
            }
            if (is_array($type)) {
                $params = array_merge($type, $params);
            } else {
                $params['class'] = $type;
            }
        }

        return Yii::createObject($params);
    }

    /**
     * Returns a value indicating whether the searcher is active for the given scenario and attribute.
     *
     * A searcher is active if
     *
     * - the searcher's `on` property is empty, or
     * - the searcher's `on` property contains the specified scenario
     *
     * @param string $scenario scenario name
     * @return boolean whether the searcher applies to the specified scenario.
     */
    public function isActive($scenario)
    {
        return !in_array($scenario, $this->except, true) && (empty($this->on) || in_array($scenario, $this->on, true));
    }

    /**
     * Searches the specified object.
     * @param \yii\db\ActiveRecord $object the data object being searched
     * @param array|null $attributes the list of attributes to be searched.
     * Note that if an attribute is not associated with the searcher,
     * it will be ignored.
     * If this parameter is null, every attribute listed in [[attributes]] will be searched.
     */
    public function searchAttributes($object, $attributes = null)
    {
        if (is_array($attributes)) {
            $attributes = array_intersect($this->attributes, $attributes);
        } else {
            $attributes = $this->attributes;
        }
        foreach ($attributes as $attribute) {
            $this->searchAttribute($object, $attribute);
        }
    }

    /**
     * Searches a single attribute.
     * Child classes must implement this method to provide the actual search logic.
     * @param \yii\db\ActiveRecord $object the data object to be searched
     * @param string $attribute the name of the attribute to be searched.
     * @throws NotSupportedException
     */
    public function searchAttribute($object, $attribute)
    {
        throw new NotSupportedException(get_class($this) . ' does not support searchAttribute().');
    }

    public function renderSearchAttributes($object, $attributes = null)
    {
        if (!$this->display) {
            return '';
        }
        $searchAttributeHtml = '';
        if (is_array($attributes)) {
            $attributes = array_intersect($this->attributes, $attributes);
        } else {
            $attributes = $this->attributes;
        }
        foreach ($attributes as $attribute) {
            $searchAttributeHtml .= $this->buildAttributeField($object, $attribute);
        }
        return $searchAttributeHtml;
    }

    /**
     * Searches a single attribute.
     * Child classes must implement this method to provide the actual search logic.
     * @param \yii\db\ActiveRecord $object the data object to be searched
     * @param string $attribute the name of the attribute to be searched.
     * @return string
     * @throws NotSupportedException
     */
    public function buildAttributeField($object, $attribute)
    {
        throw new NotSupportedException(get_class($this) . ' does not support buildAttributeField().');
    }

    /**
     * @param \kiwi\db\ActiveRecord $object the data object to be searched
     * @param string $attribute the name of the attribute to be searched.
     * @return string
     */
    public function getAttribute($object, $attribute)
    {
        if ($object->hasAttribute($attribute)) {
            return $object->tableName() . '.' . $attribute;
        }
        if ($object->searcherQuery->joinWith) {
            foreach ($object->searcherQuery->joinWith as $joinWith) {
                $relations = $joinWith[0];
                foreach ($relations as $relation) {
                    $relation = $object->getRelation($relation);
                    /** @var \yii\db\ActiveRecord $model */
                    $model = Yii::createObject($relation->modelClass);
                    if ($model->hasAttribute($attribute)) {
                        return $model->tableName() . '.' . $attribute;
                    }
                }
            }
        }
        return false;
    }
} 