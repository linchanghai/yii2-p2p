<?php

namespace core\cms\models;

use Yii;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "cms_notice".
 *
 * @property integer $cms_notice_id
 * @property integer $type
 * @property string $img
 * @property string $title
 * @property string $content
 * @property integer $create_time
 * @property integer $update_time
 * @property integer $publihser_date
 * @property string $create_by
 * @property string $update_by
 * @property integer $is_delete
 */
class CmsNotice extends \kiwi\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cms_notice';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['type', 'create_time', 'update_time',  'is_delete'], 'integer'],
            [['title', 'content', 'publihser_date'], 'required'],
            [['content'], 'string'],
            [['img', 'title'], 'string', 'max' => 100],
            [['create_by', 'update_by'], 'string', 'max' => 45]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'cms_notice_id' => Yii::t('core_cms', 'Cms Notice ID'),
            'type' => Yii::t('core_cms', 'Type'),
            'img' => Yii::t('core_cms', 'Img'),
            'title' => Yii::t('core_cms', 'Title'),
            'content' => Yii::t('core_cms', 'Content'),
            'create_time' => Yii::t('core_cms', 'Create Time'),
            'update_time' => Yii::t('core_cms', 'Update Time'),
            'publihser_date' => Yii::t('core_cms', 'Publihser Date'),
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
