<?php

namespace core\auth\models;

use Yii;

/**
 * This is the model class for table "{{%auth_item}}".
 *
 * @property string $name
 * @property integer $type
 * @property string $description
 * @property string $rule_name
 * @property string $data
 * @property integer $created_at
 * @property integer $updated_at
 *
 * @property AuthRule $ruleName
 */
class AuthItem extends \kiwi\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%auth_item}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'type'], 'required'],
            [['type', 'created_at', 'updated_at'], 'integer'],
            [['description', 'data'], 'string'],
            [['name', 'rule_name'], 'string', 'max' => 64]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'name' => Yii::t('core_auth', 'Name'),
            'type' => Yii::t('core_auth', 'Type'),
            'description' => Yii::t('core_auth', 'Description'),
            'rule_name' => Yii::t('core_auth', 'Rule Name'),
            'data' => Yii::t('core_auth', 'Data'),
            'created_at' => Yii::t('core_auth', 'Created At'),
            'updated_at' => Yii::t('core_auth', 'Updated At'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRuleName()
    {
        return $this->hasOne(AuthRule::className(), ['name' => 'rule_name']);
    }
}
