<?php
/**
 * @author Lujie.Zhou(lujie.zhou@jago-ag.cn)
 * @Date 5/27/2015
 * @Time 2:27 PM
 */

namespace kiwi\models;


use kiwi\base\AspectTrait;
use kiwi\db\ActiveRecord;
use kiwi\helpers\CheckHelper;
use kiwi\helpers\SerializerHelper;
use Yii;
use yii\helpers\ArrayHelper;
use yii\helpers\Json;

/**
 * Class KeyValueModel
 *
 * @property array $definition
 * @property array $customValues
 *
 * 'setting' => [
 *      'systemConfiguration' => [
 *          'label' => Yii::t('app', '系统配置'),
 *          'sort' => 100,
 *          'groups' => [
 *              'siteConfig' => [
 *                  'label' => Yii::t('app', '站点配置'),
 *                  'sort' => 100,
 *                  'fields' => [
 *                      'siteName' => [
 *                          'label' => Yii::t('app', '网站名称'),
 *                          'sort' => 10,
 *                          'inputType' => 'text',
 *                          'dataType' => 'string',
 *                          'value' => '猕猴桃',
 *                          'hint' => Yii::t('app', '出现在每个页面的title后面'),
 *                      ]
 *                  ]
 *              ],
 *              'notification' => [
 *                  'label' => Yii::t('app', '通知配置'),
 *                  'sort' => 100,
 *                  'fields' => [
 *                      'isEnable' => [
 *                          'label' => Yii::t('app', '是否启用'),
 *                          'sort' => 10,
 *                          'inputType' => 'radio',
 *                          'dataType' => 'integer',
 *                          'dataList' => ['1' => Yii::t('app', '是'), '0' => Yii::t('app', '否')],
 *                          'dataSource' => ['xxxClass', 'xxxFunction'], //if dataSource is set, use dataSource insteadof dataList
 *                          'value' => '猕猴桃',
 *                          'hint' => Yii::t('app', '出现在每个页面的title后面'),
 *                      ]
 *                  ]
 *              ],
 *          ]
 *      ]
 * ]
 *
 * @package kiwi\models
 * @author Lujie.Zhou(lujie.zhou@jago-ag.cn)
 */
abstract class KeyValueModel extends ActiveRecord
{
    use AspectTrait;

    /** @var \yii\db\ActiveRecord */
    public $modelClass;

    public $keyAttribute = 'key';

    public $valueAttribute = 'value';

    public $_definition;

    public $labelKey = 'label';

    public $valueKey = 'value';

    public $dataListKey = 'dataList';

    public $dataSourceKey = 'dataSource';

    public $inputTypeKey = 'inputType';

    public $dataTypeKey = 'dataType';

    /** @var string json or serialize or callable function */
    public $serializer = 'json';

    public function init()
    {
        parent::init();
        $this->loadDefinition();
        $this->loadAttributes();
    }

    public function loadDefinition()
    {
        $this->_definition = $this->getDefinition();
    }

    public function loadAttributes()
    {
        $attributeValues = ArrayHelper::merge($this->_definition, $this->customValues);
        foreach ($attributeValues as $attribute => $field) {
            if ($field[$this->inputTypeKey] == 'checkbox') {
                $field[$this->valueAttribute] = SerializerHelper::decode($field[$this->valueAttribute], true, $this->serializer);
            }
            $this->setAttribute($attribute, $field[$this->valueAttribute]);
        }
    }

    abstract public function getDefinition();

    public function getCustomValues()
    {
        $model = $this->modelClass;
        $data = $model::find()->all();
        $config = [];
        foreach ($data as $m) {
            $config[$m->{$this->keyAttribute}] = [$this->valueKey => $m->{$this->valueAttribute}];
        }
        return $config;
    }

    #region override ActiveRecord functions

    /**
     * @inheritdoc
     */
    public function rules()
    {
        $rules = [];
        $keys = ['required' => [], 'safe' => []];

        foreach ($this->_definition as $key => $field) {
            if (isset($field[$this->dataTypeKey])) {
                if (is_array($field[$this->dataTypeKey])) {
                    $validator = $field[$this->dataTypeKey][0];
                    unset($field[$this->dataTypeKey][0]);
                    $rules[] = ArrayHelper::merge([$key, $validator], $field[$this->dataTypeKey]);
                } else {
                    $dataType = $field[$this->dataTypeKey];
                    if (!isset($keys[$dataType])) {
                        $keys[$dataType] = [];
                    }
                    $keys[$dataType][] = $key;
                }
            } else if (in_array($field[$this->inputTypeKey], ['checkbox', 'select', 'radio'])) {
                $allowArray = $field[$this->inputTypeKey] == 'checkbox';
                $dataList = isset($field[$this->dataListKey]) ? $field[$this->dataListKey] : [];
                $dataList = isset($field[$this->dataSourceKey]) && CheckHelper::isCallable($field[$this->dataSourceKey])
                    ? call_user_func($field[$this->dataSourceKey]) : $dataList;
                $rules[] = [$key, 'in', $dataList, 'allowArray' => $allowArray];
            } else {
                $keys['safe'][] = $key;
            }
        }

        foreach ($keys as $validator => $attributes) {
            $rules[] = [$attributes, $validator];
        }

        return $rules;
    }

    /**
     * @inheritdoc
     */
    public function attributes()
    {
        return array_keys($this->_definition);
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        $attributeLabels = [];
        foreach ($this->_definition as $key => $field) {
            $attributeLabels[$key] = $field[$this->labelKey];
        }
        return $attributeLabels;
    }

    /**
     * @inheritdoc
     */
    public function save($runValidation = true, $attributeNames = null)
    {
        if ($runValidation && !$this->validate($attributeNames)) {
            Yii::info('Model not save due to validation error.', __METHOD__);
            return false;
        }
        $db = static::getDb();
        if ($this->isTransactional(self::OP_ALL)) {
            $transaction = $db->beginTransaction();
            try {
                $result = $this->saveInternal();
                if ($result === false) {
                    $transaction->rollBack();
                } else {
                    $transaction->commit();
                }
            } catch (\Exception $e) {
                $transaction->rollBack();
                throw $e;
            }
        } else {
            $result = $this->saveInternal();
        }

        return $result;
    }

    protected function saveInternal()
    {
        if (!$this->beforeSave(false)) {
            return false;
        }

        $model = $this->modelClass;
        foreach ($this->getAttributes() as $key => $value) {
            if ($this->_definition[$key][$this->inputTypeKey] == 'checkbox' && is_array($value)) {
                $value = SerializerHelper::encode($value, $this->serializer);
            }

            if (isset($this->_definition[$key][$this->valueKey]) && $this->_definition[$key][$this->valueKey] == $value) {
                $model::deleteAll([$this->keyAttribute => $key]);
            } else {
                $m = $model::findOne([$this->keyAttribute => $key]) ?: Yii::createObject(['class' => $this->modelClass, $this->keyAttribute => $key]);
                $m->value = $value;
                if (!$m->save()) {
                    $this->addError($key, Json::encode($m->getErrors()));
                }
            }
        }

        $this->afterSave(false, $this->attributes());

        return !$this->hasErrors();
    }

    #endregion override ActiveRecord functions
}