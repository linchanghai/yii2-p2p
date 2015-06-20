<?php
/**
 * @author Lujie.Zhou(gao_lujie@live.cn)
 * @Date 10/22/2014
 * @Time 5:32 PM
 */

namespace core\auth\models;

use kiwi\db\ActiveRecord;
use kiwi\Kiwi;
use Yii;
use yii\helpers\ArrayHelper;

/**
 * Class UserModel
 * @package core\auth\models
 * @author jeremy.zhou(gao_lujie@live.cn)
 */
class UserModel extends ActiveRecord
{
    /** @var \core\user\models\User */
    public $user;

    protected $_attributeLabels = [];

    protected $_attributeData = [];

    public function init()
    {
        parent::init();
        $this->initModel();
    }

    public function initModel()
    {
        $authManager = Yii::$app->getAuthManager();
        $roles = $authManager->getRoles();
        $rolesData = [];
        foreach ($roles as $key => $role) {
            $rolesData[$role->name] = $role->description;
        }
        $this->_attributeData['roles'] = $rolesData;

        if (!$this->user) {
            $this->user = Kiwi::createObject(Yii::$app->user->identityClass);
            $this->user->generateAuthKey();
        }

        if (!$this->user->isNewRecord) {
            $this->setAttributes($this->user->getAttributes());
            $userRoles = $authManager->getRolesByUser($this->user->id);
            $roleNames = [];
            foreach ($userRoles as $role) {
                $roleNames[] = $role->name;
            }
            $this->setAttribute('roles', $roleNames);
        }
    }

    public function getAttributeData($name)
    {
        return isset($this->_attributeData[$name]) ? $this->_attributeData[$name] : [];
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        /** @var \core\user\models\User $userClass */
        $userClass = Yii::$app->user->identityClass;
        return $userClass::tableName();
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
        if (!$this->user) {
            $this->user = Kiwi::createObject(Yii::$app->user->identityClass);
            $this->user->generateAuthKey();
        }

        if (!$this->_attributeLabels) {
            $attributeLabels = [
                'roles' => Yii::t('core_auth', 'Roles'),
                'password' => Yii::t('core_auth', 'Password')
            ];
            $this->_attributeLabels = ArrayHelper::merge($this->user->attributeLabels(), $attributeLabels);
        }
        return $this->_attributeLabels;
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        $rules = [
            [['roles'], 'safe'],
            ['password', 'required', 'on' => ['create']],
            ['password', 'string', 'min' => 6, 'on' => ['create']],
        ];
        $rules = ArrayHelper::merge($this->user->rules(), $rules);
        return $rules;
    }

    /**
     * @inheritdoc
     */
    public function getIsNewRecord()
    {
        return $this->user->isNewRecord;
    }

    public function scenarios()
    {
        $scenarios = parent::scenarios();
        $scenarios['create'] = $this->attributes();
        return $scenarios;
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

        $this->user->setAttributes($this->getAttributes());
        if ($this->getAttribute('password')) {
            $this->user->setPassword($this->getAttribute('password'));
        }
        if ($this->user->save()) {
            $this->saveRoles();
        } else {
            foreach ($this->user->getErrors() as $attribute => $errors) {
                foreach ($errors as $error) {
                    $this->addError($attribute, $error);
                }
            }
        }

        $this->afterSave(false, $this->attributes());
        return !$this->hasErrors();
    }

    protected function saveRoles()
    {
        $roleNames = $this->getAttribute('roles');
        $roleNames = $roleNames ? array_combine($roleNames, $roleNames) : [];
        $authManager = Yii::$app->getAuthManager();
        $userRoles = $authManager->getRolesByUser($this->user->id);
        foreach ($userRoles as $role) {
            if (isset($roleNames[$role->name])) {
                unset($roleNames[$role->name]);
            } else {
                $authManager->revoke($role, $this->user->id);
            }
        }
        foreach ($roleNames as $roleName) {
            $role = $authManager->getRole($roleName);
            if ($role) {
                $authManager->assign($role, $this->user->id);
            }
        }
    }

    /**
     * @param \yii\bootstrap\ActiveForm $form
     * @param array $options
     * @return string
     */
    public function renderForm($form, $options = [])
    {
        if (!$options) {
            $template = "{label}\n<div class=\"col-sm-11\">{input}\n{hint}\n{error}</div>";
            $labelOptions = ['class' => 'control-label col-sm-1'];
            $options = ['template' => $template, 'labelOptions' => $labelOptions];
        }
        $html = '';
        $html .= $form->field($this, 'username', $options);
        $html .= $form->field($this, 'email', $options);
        $html .= $form->field($this, 'password', $options)->passwordInput();
        $html .= $form->field($this, 'status', $options)->inline()->radioList(Kiwi::getDataListModel()->isUserActive);
        $html .= $form->field($this, 'roles', $options)->inline()->checkboxList($this->getAttributeData('roles'));
        return $html;
    }
} 