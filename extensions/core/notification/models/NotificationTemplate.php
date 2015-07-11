<?php

namespace core\notification\models;

use Yii;

/**
 * This is the model class for table "{{%notification_template}}".
 *
 * @property integer $notification_template_id
 * @property string $event
 * @property string $type
 * @property string $title
 * @property string $template
 * @property string $receiver
 * @property integer $active
 */
class NotificationTemplate extends \kiwi\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%notification_template}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['event', 'type', 'title', 'template', 'receiver', 'active'], 'required'],
            [['active'], 'integer'],
            [['event', 'type', 'title', 'receiver'], 'string', 'max' => 255],
            [['template'], 'string', 'max' => 1023]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'notification_template_id' => Yii::t('core_notification', 'Notification Template ID'),
            'event' => Yii::t('core_notification', 'Event'),
            'type' => Yii::t('core_notification', 'Type'),
            'title' => Yii::t('core_notification', 'Title'),
            'template' => Yii::t('core_notification', 'Template'),
            'receiver' => Yii::t('core_notification', 'Receiver'),
            'active' => Yii::t('core_notification', 'Active'),
        ];
    }
}
