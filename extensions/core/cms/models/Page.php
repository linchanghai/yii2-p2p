<?php

namespace core\cms\models;

use Yii;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "{{%Page}}".
 *
 * @property integer $page_id
 * @property string $key
 * @property string $title
 * @property string $content
 * @property string $layout
 * @property integer $created_at
 * @property integer $created_by
 * @property integer $updated_at
 * @property integer $updated_by
 */
class Page extends \kiwi\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%Page}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['key', 'title', 'content', 'layout'], 'required'],
            [['content'], 'string'],
            [['key', 'title', 'layout'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'page_id' => Yii::t('core_cms', 'Page ID'),
            'key' => Yii::t('core_cms', 'Key'),
            'title' => Yii::t('core_cms', 'Title'),
            'content' => Yii::t('core_cms', 'Content'),
            'layout' => Yii::t('core_cms', 'Layout'),
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
}
