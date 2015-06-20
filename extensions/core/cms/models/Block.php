<?php

namespace core\cms\models;

use Yii;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "{{%block}}".
 *
 * @property integer $block_id
 * @property string $key
 * @property string $content
 * @property integer $created_at
 * @property integer $created_by
 * @property integer $updated_at
 * @property integer $updated_by
 */
class Block extends \kiwi\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%block}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['key', 'content'], 'required'],
            [['content'], 'string'],
            [['key'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'block_id' => Yii::t('core_cms', 'Block ID'),
            'key' => Yii::t('core_cms', 'Key'),
            'content' => Yii::t('core_cms', 'Content'),
            'created_at' => Yii::t('core_cms', 'Created At'),
            'created_by' => Yii::t('core_cms', 'Created By'),
            'updated_at' => Yii::t('core_cms', 'Updated At'),
            'updated_by' => Yii::t('core_cms', 'Updated By'),
        ];
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'timestamp' => TimestampBehavior::className(),
            'blameable' => BlameableBehavior::className(),
        ];
    }

    /**
     * @param string $key the block key
     * @return Block|null
     */
    public function findByKey($key)
    {
        return static::findOne(['key' => $key]);
    }

    public function toString($params = [])
    {
        $p = [];
        foreach ($params as $name => $value) {
            $p['{' . $name . '}'] = $value;
        }

        return strtr($this->content, $p);
    }

    public function __toString()
    {
        return $this->toString();
    }
}
