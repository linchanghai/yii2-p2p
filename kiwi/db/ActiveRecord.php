<?php
/**
 * @link http://www.yiikiwi.com/
 * @copyright Copyright (c) 2015 yiikiwi
 * @license http://www.yiikiwi.com/license/
 */

namespace kiwi\db;

use ArrayObject;
use kiwi\searchers\Searcher;
use Yii;
use yii\base\InvalidConfigException;
use yii\base\ModelEvent;
use yii\data\ActiveDataProvider;
use yii\db\Exception;
use yii\helpers\ArrayHelper;

/**
 * Class ActiveRecord
 * @package kiwi\db
 * @author jeremy.zhou(gao_lujie@live.cn)
 */
class ActiveRecord extends \yii\db\ActiveRecord
{

    #region magic function override

    /**
     * @inheritdoc
     */
    public function __get($name)
    {
        if (isset($this->_relations[$name])) {
            return $this->_relations[$name];
        }
        return parent::__get($name);
    }

    /**
     * @inheritdoc
     */
    public function __set($name, $value)
    {
        if ($this->setRelation($name, $value)) return;
        parent::__set($name, $value);
    }

    /**
     * @inheritdoc
     */
    public function load($data, $formName = null)
    {
        foreach ($data as $name => $value) {
            $this->setRelation($name, $value);
        }
        return parent::load($data, $formName);
    }

    #endregion magic function override

    #region relation save

    /**
     * @var array save the relation data
     */
    private $_relations = [];

    /**
     * @var array to delete relation record ids
     */
    private $_toDeleteRelations = [];

    /**
     * convert relation array to model
     * @param string $name
     * @param array|ActiveRecord|ActiveRecord[] $values
     * @param null|string $indexKey
     * @return bool
     */
    public function setRelation($name, $values, $indexKey = null)
    {
        if ($name == end(explode('\\', $this->className()))) {
            return false;
        }
        $name = lcfirst($name);
        if ((is_array($values) || $values instanceof ActiveRecord) && $relation = $this->getRelation($name, false)) {
            if ($relation->multiple) {
                /** @var \kiwi\db\ActiveRecord $model */
                $model = Yii::createObject($relation->modelClass);
                if (!$indexKey) {
                    $primaryKeys = $model->primaryKey();
                    $indexKey = $primaryKeys[0];
                }

                /** @var \kiwi\db\ActiveRecord[] $oldRelations */
                $oldRelations = $relation->findFor($name, $this);
                $savedModelList = [];
                foreach ($oldRelations as $value) {
                    $savedModelList[$value->$indexKey] = $value;
                }

                foreach ($values as $key => $value) {
                    if (!empty($value[$indexKey]) && !empty($savedModelList[$value[$indexKey]])) {
                        $model = clone($savedModelList[$value[$indexKey]]);
                        unset($savedModelList[$value[$indexKey]]);
                    } else if ($value instanceof ActiveRecord) {
                        $model = $value;
                    } else {
                        $model = Yii::createObject($relation->modelClass);
                    }

                    if (!($value instanceof ActiveRecord)) {
                        $model->setAttributes($value);
                    }
                    //just to access the validate
                    foreach ($relation->link as $fk => $pk) {
                        $model->$fk = 0;
                    }
                    $values[$key] = $model;
                }
                $this->_relations[$name] = $values;
                $this->_toDeleteRelations[$name] = ['key' => $indexKey, 'value' => array_keys($savedModelList)];
            } else {
                /** @var \kiwi\db\ActiveRecord $model */
                $model = $this->$name;
                if (empty($model)) {
                    $model = Yii::createObject($relation->modelClass);
                    //just to access the validate
                    foreach ($relation->link as $fk => $pk) {
                        $model->$fk = 0;
                    }
                }
                if ($values instanceof ActiveRecord) {
                    $model = $values;
                } else {
                    $model->setAttributes($values);
                }
                $this->_relations[$name] = $model;
            }
            return true;
        }
        return false;
    }

    /**
     * @param null|array $attributeNames
     * @param bool $clearErrors
     * @return bool
     */
    public function validateRelations($attributeNames = null, $clearErrors = true)
    {
        //get related model validate attributes
        $relatedAttributeNames = [];
        if ($attributeNames) {
            foreach ($attributeNames as $attribute) {
                if (($pos = strpos($attribute, '.')) !== false) {
                    $relatedName = substr($attributeNames, 0, $pos + 1);
                    $relatedAttribute = substr($attributeNames, $pos + 2);
                    if (!isset($relatedAttributeNames[$relatedName])) {
                        $relatedAttributeNames[$relatedName] = [];
                    }
                    $relatedAttributeNames[$relatedName][] = $relatedAttribute;
                }
            }
        }
        //validate relations
        foreach ($this->_relations as $name => $models) {
            $modelAttributeNames = isset($relatedAttributeNames[$name]) ? $relatedAttributeNames[$name] : null;
            if (is_array($models)) {
                foreach ($models as $model) {
                    /** @var \yii\db\ActiveRecord $model */
                    if (!$model->validate($modelAttributeNames, $clearErrors)) {
                        $this->addError($name, $model->getErrors());
                    }
                }
            } else {
                /** @var \yii\db\ActiveRecord $models */
                if (!$models->validate($modelAttributeNames, $clearErrors)) {
                    $this->addError($name, $models->getErrors());
                }
            }
        }
        return !$this->hasErrors();
    }

    /**
     * @return bool
     */
    public function saveRelations()
    {
        foreach ($this->_relations as $name => $models) {
            $relation = $this->getRelation($name);
            if (is_array($models)) {
                foreach ($models as $model) {
                    /** @var \yii\db\ActiveRecord $model */
                    foreach ($relation->link as $fk => $pk) {
                        $model->$fk = $this->$pk;
                    }
                    if (!$model->save(false)) {
                        $this->addError($name, $model->getErrors());
                    }
                }
                if (!empty($this->_toDeleteRelations[$name]) && !empty($this->_toDeleteRelations[$name]['value'])) {
                    $condition = [];
                    foreach ($relation->link as $fk => $pk) {
                        $condition[$fk] = $this->$pk;
                    }
                    $condition[$this->_toDeleteRelations[$name]['key']] = $this->_toDeleteRelations[$name]['value'];
                    /** @var \yii\db\ActiveRecord $modelClass */
                    $modelClass = $relation->modelClass;
                    $modelClass::deleteAll($condition);
                }
            } else {
                /** @var \yii\db\ActiveRecord $models */
                foreach ($relation->link as $pk => $fk) {
                    $models->$pk = $this->$fk;
                }
                if (!$models->save(false)) {
                    $this->addError($name, $models->getErrors());
                }
            }
        }
        if ($this->hasErrors()) {
            return false;
        }

        foreach ($this->_relations as $name => $models) {
            $relation = $this->getRelation($name);
            // update lazily loaded related objects
            if ($relation->multiple && $relation->indexBy !== null) {
                $indexBy = $relation->indexBy;
                $relationModels = [];
                foreach ($models as $model) {
                    $relationModels[$model->$indexBy] = $model;
                }
                $models = $relationModels;
            }
            $this->populateRelation($name, $models);
        }
        $this->_relations = [];
        $this->_toDeleteRelations = [];
        return true;
    }

    /**
     * need to validate the relation models
     * @inheritdoc
     */
    public function validate($attributeNames = null, $clearErrors = true)
    {
        return parent::validate($attributeNames, $clearErrors) && $this->validateRelations($attributeNames, $clearErrors);
    }

    /**
     * save relation data after save model
     * @inheritdoc
     */
    public function afterSave($insert, $changedAttributes)
    {
        if (!$this->saveRelations()) {
            throw new Exception(Yii::t('kiwi', 'Save relation model fail!'), $this->getErrors());
        }
        parent::afterSave($insert, $changedAttributes);
    }

    #endregion relation save

    #region searcher

    /**
     * @event ModelEvent an event raised at the beginning of [[search()]]. You may set
     * [[ModelEvent::isValid]] to be false to stop the search.
     */
    const EVENT_BEFORE_SEARCH = 'beforeSearch';
    /**
     * @event Event an event raised at the end of [[search()]]
     */
    const EVENT_AFTER_SEARCH = 'afterSearch';

    /**
     * @var \yii\db\ActiveQuery
     */
    public $searcherQuery;

    /**
     * @var \ArrayObject list of searchers
     */
    private $_searchers;

    private $_queryParams;


    public function filters()
    {
        return [];
    }

    public function clearQuery()
    {
        $this->searcherQuery = static::find();
    }

    public function search($params, $with = [], $attributeNames = null, $clearQuery = true)
    {
        if ($clearQuery) {
            $this->clearQuery();
        }

        if (!$this->beforeSearch()) {
            return false;
        }

        $this->loadQueryParams($params);

        if ($with) {
            $this->searcherQuery->joinWith($with);
        }

        foreach ($this->getActiveSearchers() as $searcher) {
            $searcher->searchAttributes($this, $attributeNames);
        }

        $this->afterSearch();

        return $dataProvider = new ActiveDataProvider([
            'query' => $this->searcherQuery,
        ]);
    }

    public function renderSearch($attributeNames = null)
    {
        $searchHtml = '';
        foreach ($this->getSearchers() as $searcher) {
            $searchHtml .= $searcher->renderSearchAttributes($this, $attributeNames);
        }
        return $searchHtml;
    }

    /**
     * Returns all the searchers declared in [[rules()]].
     *
     * This method differs from [[getActiveSearchers()]] in that the latter
     * only returns the searchers applicable to the current [[scenario]].
     *
     * Because this method returns an ArrayObject object, you may
     * manipulate it by inserting or removing searchers (useful in model behaviors).
     * For example,
     *
     * ~~~
     * $model->searchers[] = $newSearcher;
     * ~~~
     *
     * @return ArrayObject|\kiwi\searchers\Searcher[] all the searchers declared in the model.
     */
    public function getSearchers()
    {
        if ($this->_searchers === null) {
            $this->_searchers = $this->createSearchers();
        }
        return $this->_searchers;
    }

    /**
     * Returns the searchers applicable to the current [[scenario]].
     * @param string $attribute the name of the attribute whose applicable searchers should be returned.
     * If this is null, the searchers for ALL attributes in the model will be returned.
     * @return \kiwi\searchers\Searcher[] the searchers applicable to the current [[scenario]].
     */
    public function getActiveSearchers($attribute = null)
    {
        $searchers = [];
        $scenario = $this->getScenario();
        foreach ($this->getSearchers() as $searcher) {
            if ($searcher->isActive($scenario) && ($attribute === null || in_array($attribute, $searcher->attributes, true))) {
                $searchers[] = $searcher;
            }
        }
        return $searchers;
    }

    /**
     * Creates searcher objects based on the search rules specified in [[rules()]].
     * Unlike [[getSearchers()]], each time this method is called, a new list of searchers will be returned.
     */
    public function createSearchers()
    {
        $searchers = new ArrayObject();
        foreach ($this->filters() as $filter) {
            if ($filter instanceof Searcher) {
                $searchers->append($filter);
            } elseif (is_array($filter) && isset($filter[0], $filter[1])) { // attributes, searcher type
                $searcher = Searcher::createSearcher($filter[1], $this, (array)$filter[0], array_slice($filter, 2));
                $searchers->append($searcher);
            } else {
                throw new InvalidConfigException('Invalid searcher filter: a filter must specify both attribute names and searcher type.');
            }
        }
        return $searchers;
    }

    public function getSearchAttributes()
    {
        $searchAttributes = [];
        foreach ($this->filters() as $filter) {
            if (is_array($filter) && isset($filter[0], $filter[1])) {
                if (is_array($filter[0])) {
                    $searchAttributes = array_merge($searchAttributes, $filter[0]);
                } else {
                    $searchAttributes[] = $filter[0];
                }
            }
        }
        return array_unique($searchAttributes);
    }

    public function getDisplaySearchAttributes()
    {
        $searchAttributes = [];
        foreach ($this->filters() as $filter) {
            if (is_array($filter) && isset($filter[0], $filter[1])) {
                if (isset($filter['display']) && !($filter['display'])) {
                    continue;
                }
                if (is_array($filter[0])) {
                    $searchAttributes = array_merge($searchAttributes, $filter[0]);
                } else {
                    $searchAttributes[] = $filter[0];
                }
            }
        }
        return array_unique($searchAttributes);
    }

    public function beforeSearch()
    {
        $event = new ModelEvent();
        $this->trigger(self::EVENT_BEFORE_SEARCH, $event);

        return $event->isValid;
    }

    public function afterSearch()
    {
        $this->trigger(self::EVENT_AFTER_SEARCH);
    }

    public function loadQueryParams($data, $formName = null)
    {
        $this->load($data, $formName);

        $scope = $formName === null ? $this->formName() : $formName;
        if ($scope == '' && !empty($data)) {
            $this->_queryParams = $data;

            return true;
        } elseif (isset($data[$scope])) {
            $this->_queryParams = $data[$scope];

            return true;
        } else {
            return false;
        }
    }

    public function getQueryParam($name = null)
    {
        if ($name === null) {
            return $this->_queryParams;
        }
        return isset($this->_queryParams[$name]) ? $this->_queryParams[$name] : null;
    }

    #endregion searcher

    #region logic delete

    public static $enableLogicDelete = false;

    public static $isDeleteAttribute = 'is_delete';

    public static $enableCascadeDelete = false;

    public static $cascadeDeleteRelations = [];

    const IS_DELETE_TRUE = 1;
    const IS_DELETE_FALSE = 0;

    /**
     * @inheritdoc
     */
    public function beforeSave($insert)
    {
        if (static::$enableLogicDelete && $insert) {
            $this->{static::$isDeleteAttribute} = static::IS_DELETE_FALSE;
        }
        return parent::beforeSave($insert);
    }

    /**
     * @inheritdoc
     */
    public static function deleteAll($condition = '', $params = [])
    {
        if (static::$enableCascadeDelete) {
            $models = static::findAll($condition);
            static::deleteAllRelations($models);
        }
        if (static::$enableLogicDelete) {
            $attributes = [static::$isDeleteAttribute => static::IS_DELETE_TRUE];
            return static::updateAll($attributes, $condition, $params);
        }
        return parent::deleteAll($condition, $params);
    }

    /**
     * @param array $models
     */
    public static function deleteAllRelations($models)
    {
        $model = new static;
        foreach (static::$cascadeDeleteRelations as $name) {
            $name = lcfirst($name);
            /** @var \yii\db\ActiveQuery $relation */
            if ($relation = $model->getRelation($name, true)) {
                /** @var \yii\db\ActiveRecord $modelClass */
                $modelClass = $relation->modelClass;
                $condition = [];
                foreach ($relation->link as $fk => $pk) {
                    $condition[$fk] = ArrayHelper::getColumn($models, $pk);
                }
                $modelClass::deleteAll($condition);
            }
        }
    }

    /**
     * @inheritdoc
     */
    public static function find()
    {
        if (static::$enableLogicDelete) {
            $condition = [static::$isDeleteAttribute => static::IS_DELETE_FALSE];
            return parent::find()->andWhere($condition);
        }
        return parent::find();
    }

    #endregion logic delete
} 