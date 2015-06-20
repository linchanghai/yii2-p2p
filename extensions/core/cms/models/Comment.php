<?php

namespace core\cms\models;

use Yii;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "{{%comment}}".
 *
 * @property integer $comment_id
 * @property integer $type
 * @property integer $link_id
 * @property integer $parent_id
 * @property string $content
 * @property integer $created_at
 * @property integer $created_by
 * @property integer $updated_at
 * @property integer $updated_by
 */
class Comment extends \kiwi\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%comment}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['type', 'link_id', 'content'], 'required'],
            [['type', 'link_id', 'parent_id'], 'integer'],
            [['content'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'comment_id' => Yii::t('core_cms', 'Comment ID'),
            'type' => Yii::t('core_cms', 'Type'),
            'link_id' => Yii::t('core_cms', 'Link ID'),
            'parent_id' => Yii::t('core_cms', 'Parent ID'),
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
}
