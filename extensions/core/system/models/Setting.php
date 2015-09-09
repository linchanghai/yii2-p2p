<?php

namespace core\system\models;

use Yii;

/**
 * This is the model class for table "{{%setting}}".
 *
 * @property integer $setting_id
 * @property string $key
 * @property string $value
 */
class Setting extends \kiwi\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%setting}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['value', 'default', 'value' => ''],
            [['key'], 'required'],
            [['key'], 'string', 'max' => 255],
            [['value'], 'string', 'max' => 1023]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'setting_id' => Yii::t('core_system', 'Setting ID'),
            'key' => Yii::t('core_system', 'Key'),
            'value' => Yii::t('core_system', 'Value'),
        ];
    }
}
