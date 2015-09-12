<?php

namespace core\cms\models;

use Yii;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "cms_partner".
 *
 * @property integer $cms_partner_id
 * @property string $img_icon
 * @property string $title
 * @property string $content
 * @property integer $create_time
 * @property integer $update_time
 * @property string $create_by
 * @property string $update_by
 * @property integer $is_delete
 */
class CmsPartner extends \kiwi\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cms_partner';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['img_icon', 'title', 'content', ], 'required'],
            [['content'], 'string'],
            [['create_time', 'update_time', 'is_delete'], 'integer'],
            [['img_icon'], 'string', 'max' => 100],
            [['title'], 'string', 'max' => 200],
            [['create_by', 'update_by'], 'string', 'max' => 45]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'cms_partner_id' => Yii::t('core_cms', 'Cms Partner ID'),
            'img_icon' => Yii::t('core_cms', 'Img Icon'),
            'title' => Yii::t('core_cms', 'Title'),
            'content' => Yii::t('core_cms', 'Content'),
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
