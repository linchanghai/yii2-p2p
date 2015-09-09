<?php
/**
 * @author Lujie.Zhou(lujie.zhou@jago-ag.cn)
 * @Date 5/29/2015
 * @Time 5:03 PM
 */

namespace kiwi\models;


use kiwi\helpers\CheckHelper;
use kiwi\Kiwi;
use yii\base\Object;

/**
 * Class DataListModel
 *
 * 'dataList' => [
 *      'boolean' => [
 *          'label' => Yii::t('app', 'boolean'),
 *          'values' => [
 *              0 => Yii::t('app', '否'),
 *              1 => Yii::t('app', '是'),
 *          ],
 *          'isDB' => false
 *      ]
 * ]
 *
 * @package kiwi\models
 * @author Lujie.Zhou(lujie.zhou@jago-ag.cn)
 */
abstract class DataListModel extends Object
{
    /** @var \yii\db\ActiveRecord */
    public $modelClass;

    public $typeAttribute = 'type';

    public $keyAttribute = 'key';

    public $valueAttribute = 'value';

    public $isRemovedAttribute = 'is_removed';

    public $labelKey = 'label';

    public $valuesKey = 'values';

    public $valueSourceKey = 'valueSource';

    public $isDBKey = 'isDB';

    abstract public function getDataLists($onlyDB = false);

    public function getDataList($type, $onlyDB = false)
    {
        $dataLists = $this->getDataLists($onlyDB);
        return isset($dataLists[$type]) ? $dataLists[$type] : [];
    }

    public function hasDataList($type, $onlyDB = false)
    {
        $dataLists = $this->getDataLists($onlyDB);
        return isset($dataLists[$type]);
    }

    public function getDataListValues($type, $includeDBValues = true)
    {
        $dataList = $this->getDataList($type);
        if (!$dataList) {
            return [];
        }

        $valueList = isset($dataList[$this->valuesKey]) ? $dataList[$this->valuesKey] : [];
        $valueList = isset($dataList[$this->valueSourceKey]) && CheckHelper::isCallable($dataList[$this->valueSourceKey])
            ? call_user_func($dataList[$this->valueSourceKey]) : $valueList;

        if ($includeDBValues && isset($dataList[$this->isDBKey]) && $dataList[$this->isDBKey]) {
            $model = $this->modelClass;
            $models = $model::find()->andWhere([$this->typeAttribute => $type])->all();
            foreach ($models as $m) {
                if ($m->hasAttribute($this->isRemovedAttribute) && $m->{$this->isRemovedAttribute}) {
                    if (isset($valueList[$m->{$this->keyAttribute}])) {
                        unset($valueList[$m->{$this->keyAttribute}]);
                    }
                } else {
                    $valueList[$m->{$this->keyAttribute}] = $m->{$this->valueAttribute};
                }
            }
        }
        return $valueList;
    }

    public function __get($name)
    {
        return $this->getDataListValues($name);
    }

    public function __call($name, $params)
    {
        return $this->getDataListValues($name);
    }

    /**
     * @param \yii\db\ActiveRecord $model
     * @return boolean
     */
    public function addValue($model)
    {
        if ($this->hasDataList($model->{$this->typeAttribute}, true)) {
            /** @var \yii\db\ActiveRecord $m */
            $m = $model->findOne([$this->typeAttribute => $model->{$this->typeAttribute}, $this->keyAttribute => $model->{$this->keyAttribute}]);
            if ($m) {
                if ($m->hasAttribute($this->isRemovedAttribute) && $m->{$this->isRemovedAttribute}) {
                    $m->{$this->isRemovedAttribute} = 0;
                }
                $m->{$this->valueAttribute} = $model->{$this->valueAttribute};
                $model = $m;
            }
            return $model->save();
        }
        return false;
    }

    /**
     * @param \yii\db\ActiveRecord $model
     * @return boolean
     */
    public function removeValue($model)
    {
        if ($this->hasDataList($model->{$this->typeAttribute}, true)) {
            $valueList = $this->getDataListValues($model->{$this->typeAttribute}, false);
            if (isset($valueList[$model->{$this->keyAttribute}])) {
                $model->{$this->isRemovedAttribute} = 1;
                return $model->save();
            } else {
                return $model->delete();
            }
        }
        return false;
    }

    /**
     * @param \yii\db\ActiveRecord $model
     * @return boolean
     */
    public function updateValue($model)
    {
        if ($this->hasDataList($model->{$this->typeAttribute}, true)) {
            return $model->save();
        }
        return false;
    }

    /**
     * @param string $type
     * @param bool $isArray
     * @return array
     */
    public function listValues($type, $isArray = true)
    {
        $valueList = $this->getDataListValues($type);
        $values = [];
        foreach ($valueList as $key => $value) {
            $v = [ $this->typeAttribute => $type, $this->keyAttribute => $key, $this->valueAttribute => $value];
            if (!$isArray) {
                $v['class'] = $this->modelClass;
                $v = Kiwi::createObject($v);
            }
            $values[] = $v;
        }
        return $values;
    }
}