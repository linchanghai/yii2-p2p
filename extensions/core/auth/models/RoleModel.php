<?php
/**
 * @author Lujie.Zhou(gao_lujie@live.cn)
 * @Date 10/22/2014
 * @Time 1:38 PM
 */

namespace core\auth\models;


use kiwi\db\ActiveRecord;
use kiwi\Kiwi;
use Yii;
use yii\helpers\ArrayHelper;

class RoleModel extends ActiveRecord
{
    /** @var \yii\rbac\Role */
    public $role;

    protected $_attributeLabels = [];

    protected $_attributeData = [];

    public function init()
    {
        parent::init();
        $this->initModel();
    }

    public $keySeparator = '_';

    public static function formatKey($key)
    {
        return lcfirst(implode('', array_map(function ($k) {
            return ucfirst($k);
        }, explode('-', $key))));
    }

    public function initModel()
    {
        list($permissionKeys, $subPermissionKeys, $ruleNames) = $this->initAttributes();
        $this->updateAuthItems($ruleNames, $permissionKeys, $subPermissionKeys);
        $this->loadAttributeValues();
    }

    /**
     * @return array
     * @inheritdoc
     */
    protected function initAttributes()
    {
        $permissions = Kiwi::getConfiguration()->permissions;
        $permissionKeys = [];
        $subPermissionKeys = [];
        $ruleNames = [];
        foreach ($permissions as $moduleKey => $module) {
            foreach ($module['groups'] as $controllerKey => $group) {
                $attribute = $moduleKey . $this->keySeparator . $controllerKey;
                $attribute = $this->formatKey($attribute);
                $attributeData = [];
                foreach ($group['permissions'] as $actionKey => $permission) {
                    $permissionKey = $attribute . $this->keySeparator . $actionKey;
                    $permissionKey = $this->formatKey($permissionKey);
                    $attributeData[$permissionKey] = $permission['label'];
                    $permissionKeys[$permissionKey] = implode($this->keySeparator, [$module['label'], $group['label'], $permission['label']]);
                    if (isset($permission['permissionKeys'])) {
                        if (is_string($permission['permissionKeys'])) {
                            $permission['permissionKeys'] = [$permission['permissionKeys']];
                        }
                        $subPermissionKeys[$permissionKey] = $permission['permissionKeys'];
                        foreach ($permission['permissionKeys'] as $subPermissionKey) {
                            $permissionKeys[$subPermissionKey] = $subPermissionKey;
                        }
                    }
                    if (isset($permission['rule'])) {
                        $ruleNames[$permission['rule']] = $permissionKey;
                    }
                }
                $this->_attributeData[$attribute] = $attributeData;
                $this->_attributeLabels[$attribute] = $group['label'];
            }
        }
        $this->_attributeLabels['description'] = Yii::t('core_auth', 'Role Name');
        return array($permissionKeys, $subPermissionKeys, $ruleNames);
    }

    protected function loadAttributeValues()
    {
        $authManager = Yii::$app->getAuthManager();
        if ($this->role) {
            $this->setAttribute('description', $this->role->description);
            $rolePermissions = $authManager->getPermissionsByRole($this->role->name);
            foreach ($rolePermissions as $permission) {
                $keys = explode($this->keySeparator, $permission->name);
                array_pop($keys);
                $attribute = implode($this->keySeparator, $keys);
                if ($value = $this->getAttribute($attribute)) {
                    $value[] = $permission->name;
                    $this->setAttribute($attribute, $value);
                } else {
                    $this->setAttribute($attribute, [$permission->name]);
                }
            }
        }
    }

    /**
     * @param $ruleNames
     * @param $permissionKeys
     * @param $subPermissionKeys
     * @throws \yii\base\InvalidConfigException
     * @inheritdoc
     */
    protected function updateAuthItems($ruleNames, $permissionKeys, $subPermissionKeys)
    {
        $this->updateAuthRules($ruleNames);
        $this->updateAuthPermissions($permissionKeys, $ruleNames);
        $this->updatePermissionRelations($permissionKeys, $subPermissionKeys);
    }

    /**
     * @param $ruleNames
     * @return array
     * @throws \yii\base\InvalidConfigException
     * @inheritdoc
     */
    protected function updateAuthRules($ruleNames)
    {
        $authManager = Yii::$app->getAuthManager();
        $authRules = $authManager->getRules();
        foreach ($authRules as $rule) {
            if (isset($ruleNames[$rule->name])) {
                unset($ruleNames[$rule->name]);
            } else {
                $authManager->remove($rule);
            }
        }
        $ruleNames = array_flip($ruleNames);

        foreach ($ruleNames as $ruleName) {
            /** @var \yii\rbac\Rule $rule */
            $rule = Yii::createObject($ruleName);
            $authManager->add($rule);
        }
    }

    /**
     * @param $permissionKeys
     * @param $ruleNames
     * @return array
     * @throws \yii\base\InvalidConfigException
     * @inheritdoc
     */
    protected function updateAuthPermissions($permissionKeys, $ruleNames)
    {
        $authManager = Yii::$app->getAuthManager();
        $authPermissions = $authManager->getPermissions();
        foreach ($authPermissions as $permission) {
            if (isset($permissionKeys[$permission->name])) {
                unset($permissionKeys[$permission->name]);
            } else {
                $authManager->remove($permission);
            }
        }
        foreach ($permissionKeys as $name => $desc) {
            /** @var \yii\rbac\Permission $permission */
            $permission = Yii::createObject([
                'class' => 'yii\rbac\Permission',
                'name' => $name,
                'description' => $desc,
                'ruleName' => isset($ruleNames[$name]) ? $ruleNames[$name] : null,
            ]);
            $authManager->add($permission);
        }
    }

    /**
     * @param $permissionKeys
     * @param $subPermissionKeys
     * @throws \yii\base\InvalidConfigException
     * @inheritdoc
     */
    protected function updatePermissionRelations($permissionKeys, $subPermissionKeys)
    {
        $authManager = Yii::$app->getAuthManager();
        foreach ($permissionKeys as $key => $name) {
            /** @var \yii\rbac\Permission $permission */
            $permission = Yii::createObject([
                'class' => 'yii\rbac\Permission',
                'name' => $key,
            ]);
            if (isset($subPermissionKeys[$key])) {
                $subKeys = array_combine($subPermissionKeys[$key], $subPermissionKeys[$key]);
                $children = $authManager->getChildren($key);
                foreach ($children as $child) {
                    if (isset($subKeys[$child->name])) {
                        unset($subKeys[$child->name]);
                    } else {
                        $authManager->removeChild($permission, $child);
                    }
                }
                foreach ($subKeys as $subKey) {
                    /** @var \yii\rbac\Permission $subKey */
                    $subKey = Yii::createObject([
                        'class' => 'yii\rbac\Permission',
                        'name' => $subKey,
                    ]);
                    $authManager->addChild($permission, $subKey);
                }
            } else {
                $authManager->removeChildren($permission);
            }
        }
    }

    public function getAttributeData($name)
    {
        return isset($this->_attributeData[$name]) ? $this->_attributeData[$name] : [];
    }

    /**
     * @inheritdoc
     */
    public function attributes()
    {
        return array_keys($this->attributeLabels());
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return $this->_attributeLabels;
    }

    public function rules()
    {
        $rules = [
            [['description'], 'required'],
            [['description'], 'string', 'max' => 255],
        ];
        $permissionRules = [
            [$this->attributes(), 'safe']
        ];
        return ArrayHelper::merge($rules, $permissionRules);
    }

    public function getIsNewRecord()
    {
        return !$this->role;
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

        $this->saveRole();
        $this->savePermissions();

        $this->afterSave(false, $this->attributes());
        return !$this->hasErrors();
    }

    protected function saveRole()
    {
        $authManager = Yii::$app->getAuthManager();
        if (!$this->role) {
            $this->role = Yii::createObject([
                'class' => 'yii\rbac\Role',
                'name' => $this->getAttribute('description'),
                'description' => $this->getAttribute('description')
            ]);
            $authManager->add($this->role);
        } else {
            $name = $this->role->name;
            $this->role->name = $this->role->description = $this->getAttribute('description');
            $authManager->update($name, $this->role);
        }
    }

    protected function savePermissions()
    {
        $permissionKeys = [];
        $attributes = $this->getAttributes();
        unset($attributes['description']);
        foreach ($attributes as $name => $keys) {
            if ($keys) {
                $permissionKeys = ArrayHelper::merge($permissionKeys, $keys);
            }
        }
        $permissionKeys = $permissionKeys ? array_combine($permissionKeys, $permissionKeys) : [];

        $authManager = Yii::$app->getAuthManager();
        $permissions = $authManager->getPermissionsByRole($this->role->name);
        foreach ($permissions as $permission) {
            if (isset($permissionKeys[$permission->name])) {
                unset($permissionKeys[$permission->name]);
            } else {
                $authManager->removeChild($this->role, $permission);
            }
        }

        foreach ($permissionKeys as $permissionKey) {
            $permission = $authManager->getPermission($permissionKey);
            $authManager->addChild($this->role, $permission);
        }
    }

    /**
     * get the config
     * @param \yii\bootstrap\ActiveForm $form
     * @param array $options
     * @return array
     */
    public function renderForm($form, $options = [])
    {
        if (!$options) {
            $template = "{label}\n<div class=\"col-sm-11\">{input}\n{hint}\n{error}</div>";
            $labelOptions = ['class' => 'control-label col-sm-1'];
            $options = ['template' => $template, 'labelOptions' => $labelOptions];
        }

        $groups = [];
        $permissions = Kiwi::getConfiguration()->permissions;
        foreach ($permissions as $moduleKey => $module) {
            $label = $module['label'];
            $content = '';
            foreach ($module['groups'] as $controllerKey => $group) {
                $attribute = implode($this->keySeparator, [$moduleKey, $controllerKey]);
                $content .= $form->field($this, $attribute, $options)->inline()->checkboxList($this->getAttributeData($attribute));
            }
            $groups[$moduleKey] = ['label' => $label, 'content' => $content];
        }
        return $groups;
    }
} 