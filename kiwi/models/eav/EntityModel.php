<?php
/**
 * @author Lujie.Zhou(lujie.zhou@jago-ag.cn)
 * @Date 5/28/2015
 * @Time 2:21 PM
 */

namespace kiwi\models\eav;


use kiwi\db\ActiveRecord;
use kiwi\helpers\CheckHelper;
use kiwi\helpers\SerializerHelper;
use Yii;
use yii\db\Exception;
use yii\helpers\ArrayHelper;
use yii\helpers\Json;

/**
 * Class EntityModel
 *
 * @property AttributeSetModel $attributeSetModel
 * @property ValueModel[] $valueModels
 *
 * @package kiwi\models\eav
 * @author Lujie.Zhou(lujie.zhou@jago-ag.cn)
 */
class EntityModel extends ActiveRecord
{
    use EavTrait;

    public $valueAttributePrefix = 'v_';

    /** @var string json or serialize or callable function */
    public $serializer = 'json';

    public function loadAttributes()
    {
        if ($this->isNewRecord) {
            return;
        }

        $attributeModels = $this->attributeSetModel->attributeModels;
        /** @var ValueModel[] $valueModels */
        $valueModels = ArrayHelper::index($this->valueModels, $this->attributeIdAttribute);
        foreach ($attributeModels as $attributeModel) {
            $attributeId = $attributeModel->{$this->attributeIdAttribute};
            $key = $this->valueAttributePrefix . $attributeId;
            $inputType = $attributeModel->{$attributeModel->inputTypeAttribute};
            if (isset($valueModels[$attributeId])) {
                $valueModel = $valueModels[$attributeId];
                $value = $valueModel->{$valueModel->valueAttribute};
                $this->{$key} = $inputType == 'checkbox' && is_string($value) ? SerializerHelper::decode($value, $this->serializer) : $value;
            } else {
                $this->{$key} = $inputType == 'checkbox' ? [] : '';
            }
        }
    }

    public function saveEntityValues($attributeNames = null)
    {
        /** @var ValueModel $model */
        $model = Yii::createObject($this->valueClass);
        $attributeModels = $this->attributeSetModel->attributeModels;
        $keyToAttributeIds = [];
        $toSaveKeyToAttributeIds = [];
        foreach ($attributeModels as $attributeModel) {
            $key = $this->valueAttributePrefix . $attributeModel->{$this->attributeIdAttribute};
            $keyToAttributeIds[$key] = $attributeModel->{$this->attributeIdAttribute};
            if (!$attributeNames || in_array($key, $attributeNames)) {
                $toSaveKeyToAttributeIds[$key] = $attributeModel->{$this->attributeIdAttribute};
            }

            $inputType = $attributeModel->{$attributeModel->inputTypeAttribute};
            if ($inputType == 'checkbox' && is_array($this->{$key})) {
                $this->{$key} = SerializerHelper::encode($this->getAttribute($key), $this->serializer);
            }
        }

        $valueModels = ArrayHelper::index($this->valueModels, $this->attributeIdAttribute);
        foreach ($toSaveKeyToAttributeIds as $key => $attributeId) {
            if (isset($valueModels[$attributeId])) {
                $m = $valueModels[$attributeId];
            } else {
                $class = ['class' => $this->valueClass, $this->entityIdAttribute => $this->{$this->entityIdAttribute}, $this->attributeIdAttribute => $attributeId];
                $m = Yii::createObject($class);
            }

            if ($m->{$model->valueAttribute} == $this->{$key}) {
                continue;
            }
            $m->{$model->valueAttribute} = $this->{$key};
            if (!$m->save()) {
                $this->addError($key, Json::encode($m->getErrors()));
            }
            $valueModels[$attributeId] = $m;
        }

        $toDeleteAttributeIds = array_diff(array_keys($valueModels), $keyToAttributeIds);
        $model::deleteAll([$this->entityIdAttribute => $this->{$this->entityIdAttribute}, $this->attributeIdAttribute => $toDeleteAttributeIds]);

        if ($this->hasErrors()) {
            return false;
        }

        foreach ($toDeleteAttributeIds as $attributeId) {
            unset($valueModels[$attributeId]);
        }
        $this->populateRelation('valueModels', $valueModels);
        return true;
    }

    #region override ActiveRecord functions

    /**
     * @inheritdoc
     */
    public function rules()
    {
        $rules = [];
        $keys = ['required' => [], 'safe' => []];

        $attributeModels = $this->attributeSetModel->attributeModels;
        foreach ($attributeModels as $attributeModel) {
            $key = $this->valueAttributePrefix . $attributeModel->{$this->attributeIdAttribute};
            $attributeModel->{$this->attributeIdAttribute};
            $inputType = $attributeModel->{$attributeModel->inputTypeAttribute};
            $dataType = $attributeModel->{$attributeModel->dataTypeAttribute};
            if ($dataType) {
                if (is_array($dataType)) {
                    $validator = $dataType[0];
                    unset($dataType[0]);
                    $rules[] = ArrayHelper::merge([$key, $validator], $dataType);
                } else {
                    if (!isset($keys[$dataType])) {
                        $keys[$dataType] = [];
                    }
                    $keys[$dataType][] = $key;
                }
            } else if (in_array($inputType, ['checkbox', 'select', 'radio'])) {
                $allowArray = $inputType == 'checkbox';
                $dataList = $attributeModel->{$attributeModel->dataListAttribute} ?: [];
                $dataSource = $attributeModel->{$attributeModel->dataSourceAttribute};
                $dataList = CheckHelper::isCallable($dataSource) ? call_user_func($dataSource) : $dataList;
                $rules[] = [$key, 'in', $dataList, 'allowArray' => $allowArray];
            } else {
                $keys['safe'][] = $key;
            }

            if ($attributeModel->{$attributeModel->isRequiredAttribute}) {
                $keys['required'][] = $key;
            }
        }

        foreach ($keys as $validator => $attributes) {
            if ($attributes) {
                $rules[] = [$attributes, $validator];
            }
        }

        return $rules;
    }

    /**
     * @inheritdoc
     */
    public function attributes()
    {
        $attributes = [];
        $attributeModels = $this->attributeSetModel->attributeModels;
        foreach ($attributeModels as $attributeModel) {
            $attributes[] = $this->valueAttributePrefix . $attributeModel->{$this->attributeIdAttribute};
        }
        return ArrayHelper::merge(parent::attributes(), $attributes);
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        $attributeLabels = [];
        $attributeModels = $this->attributeSetModel->attributeModels;
        foreach ($attributeModels as $attributeModel) {
            $attributeLabels[$this->valueAttributePrefix . $attributeModel->{$this->attributeIdAttribute}] = $attributeModel->{$attributeModel->labelAttribute};
        }
        return $attributeLabels;
    }

    /**
     * @inheritdoc
     */
    public function save($runValidation = true, $attributeNames = null)
    {
        $attributeNames = $attributeNames ? array_diff(parent::attributes(), $attributeNames) : parent::attributes();
        $this->_saveAttributeNames = $attributeNames ? array_diff($attributeNames, parent::attributes()) : null;
        return parent::save($runValidation, $attributeNames);
    }

    private $_saveAttributeNames;

    /**
     * @inheritdoc
     */
    public function afterSave($insert, $changedAttributes)
    {
        $attributeNames = $this->_saveAttributeNames;
        $this->_saveAttributeNames = null;

        if (!$this->saveEntityValues($attributeNames)) {
            throw new Exception(Yii::t('kiwi', 'Save entity values fail!'), $this->getErrors());
        }
        parent::afterSave($insert, $changedAttributes);
    }

    #endregion override ActiveRecord functions
}