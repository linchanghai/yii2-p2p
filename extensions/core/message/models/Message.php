<?php

namespace core\message\models;

use Yii;

/**
 * This is the model class for table "{{%message}}".
 *
 * @property integer $message_id
 * @property string $title
 * @property string $content
 * @property integer $from
 * @property integer $to
 * @property integer $status
 * @property integer $created_at
 */
class Message extends \kiwi\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%message}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'content', 'created_at'], 'required'],
            [['from', 'to', 'status', 'created_at'], 'integer'],
            [['title'], 'string', 'max' => 255],
            [['content'], 'string', 'max' => 1023]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'message_id' => Yii::t('core_message', 'Message ID'),
            'title' => Yii::t('core_message', 'Title'),
            'content' => Yii::t('core_message', 'Content'),
            'from' => Yii::t('core_message', 'From'),
            'to' => Yii::t('core_message', 'To'),
            'status' => Yii::t('core_message', 'Status'),
            'created_at' => Yii::t('core_message', 'Created At'),
        ];
    }
}
