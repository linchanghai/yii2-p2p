<?php

namespace core\cms\models;

use Yii;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "cms_law".
 *
 * @property integer $cms_law_id
 * @property string $title
 * @property integer $type
 * @property string $content
 * @property string $create_by
 * @property string $update_by
 * @property integer $create_time
 * @property integer $update_time
 * @property integer $is_delete
 */
class CmsLaw extends \kiwi\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cms_law';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'type', 'content'], 'required'],
            [['type', 'create_time', 'update_time', 'is_delete'], 'integer'],
            [['content'], 'string'],
            [['title'], 'string', 'max' => 150],
            [['create_by', 'update_by'], 'string', 'max' => 45]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'cms_law_id' => Yii::t('core_cms', 'Cms Law ID'),
            'title' => Yii::t('core_cms', 'Title'),
            'type' => Yii::t('core_cms', 'Type'),
            'content' => Yii::t('core_cms', 'Content'),
            'create_by' => Yii::t('core_cms', 'Create By'),
            'update_by' => Yii::t('core_cms', 'Update By'),
            'create_time' => Yii::t('core_cms', 'Create Time'),
            'update_time' => Yii::t('core_cms', 'Update Time'),
            'is_delete' => Yii::t('core_cms', 'Is Delete'),
        ];
    }

    public function behaviors()
    {
        return [
            'time' => [
                'class' => TimestampBehavior::className(),
                'createdAtAttribute' => 'create_time',
                'updatedAtAttribute' => 'update_time',
            ],
            'user' => [
                'class' => BlameableBehavior::className(),
                'createdByAttribute' => 'create_by',
                'updatedByAttribute' => 'update_by',
            ]
        ];
    }
}
