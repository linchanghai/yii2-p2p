<?php

namespace core\system\models;

use Yii;

/**
 * This is the model class for table "{{%data_list}}".
 *
 * @property integer $data_list_id
 * @property string $type
 * @property string $key
 * @property string $value
 * @property integer $is_removed
 */
class DataList extends \kiwi\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%data_list}}';
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
            'data_list_id' => Yii::t('core_system', 'Data List ID'),
            'type' => Yii::t('core_system', 'Type'),
            'key' => Yii::t('core_system', 'Key'),
            'value' => Yii::t('core_system', 'Value'),
            'is_removed' => Yii::t('core_system', 'Is Removed'),
        ];
    }
}
