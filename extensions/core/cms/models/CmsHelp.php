<?php

namespace core\cms\models;

use Yii;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "cms_help".
 *
 * @property integer $cms_help_id
 * @property string $title
 * @property string $content
 * @property integer $type
 * @property string $create_by
 * @property string $update_by
 * @property string $create_time
 * @property string $update_time
 * @property integer $isDelete
 */
class CmsHelp extends \kiwi\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cms_help';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['cms_help_id', 'title', 'content'], 'required'],
            [['cms_help_id', 'type', 'isDelete'], 'integer'],
            [['content'], 'string'],
            [['create_time', 'update_time'], 'safe'],
            [['title', 'create_by', 'update_by'], 'string', 'max' => 45],
            [['cms_help_id'], 'unique']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'cms_help_id' => Yii::t('core_cms', 'Cms Help ID'),
            'title' => Yii::t('core_cms', 'Title'),
            'content' => Yii::t('core_cms', 'Content'),
            'type' => Yii::t('core_cms', 'Type'),
            'create_by' => Yii::t('core_cms', 'Create By'),
            'update_by' => Yii::t('core_cms', 'Update By'),
            'create_time' => Yii::t('core_cms', 'Create Time'),
            'update_time' => Yii::t('core_cms', 'Update Time'),
            'isDelete' => Yii::t('core_cms', 'Is Delete'),
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
