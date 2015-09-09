<?php

namespace core\cms\models;

use Yii;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "cms_about".
 *
 * @property integer $cms_about_id
 * @property string $title
 * @property string $content
 * @property string $img
 * @property integer $type
 * @property integer $create_time
 * @property integer $update_time
 * @property string $create_by
 * @property string $update_by
 * @property integer $is_delete
 */
class CmsAbout extends \kiwi\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cms_about';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['content', 'type'], 'required'],
            [['content'], 'string'],
            [['type', 'create_time', 'update_time', 'is_delete'], 'integer'],
            [['title', 'img'], 'string', 'max' => 100],
            [['create_by', 'update_by'], 'string', 'max' => 45]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'cms_about_id' => Yii::t('core_cms', 'Cms About ID'),
            'title' => Yii::t('core_cms', 'Title'),
            'content' => Yii::t('core_cms', 'Content'),
            'img' => Yii::t('core_cms', 'Img'),
            'type' => Yii::t('core_cms', 'Type'),
            'create_time' => Yii::t('core_cms', 'Create Time'),
            'update_time' => Yii::t('core_cms', 'Update Time'),
            'create_by' => Yii::t('core_cms', 'Create By'),
            'update_by' => Yii::t('core_cms', 'Update By'),
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
