<?php

namespace core\cms\models;

use Yii;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "cms_media".
 *
 * @property integer $cms_media_id
 * @property string $title
 * @property string $content
 * @property string $source_site
 * @property string $source_link
 * @property string $create_by
 * @property string $update_by
 * @property integer $publisher_date
 * @property integer $create_time
 * @property integer $update_time
 * @property integer $is_delete
 */
class CmsMedia extends \kiwi\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cms_media';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'publisher_date'], 'required'],
            [['content'], 'string'],
            [[ 'create_time', 'update_time', 'is_delete'], 'integer'],
            [['title'], 'string', 'max' => 100],
            [['source_site', 'create_by', 'update_by'], 'string', 'max' => 45],
            [['source_link'], 'string', 'max' => 200]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'cms_media_id' => Yii::t('core_cms', 'Cms Media ID'),
            'title' => Yii::t('core_cms', 'Title'),
            'content' => Yii::t('core_cms', 'Content'),
            'source_site' => Yii::t('core_cms', 'Source Site'),
            'source_link' => Yii::t('core_cms', 'Source Link'),
            'create_by' => Yii::t('core_cms', 'Create By'),
            'update_by' => Yii::t('core_cms', 'Update By'),
            'publisher_date' => Yii::t('core_cms', 'Publisher Date'),
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
