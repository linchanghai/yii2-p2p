<?php

namespace core\notification\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "{{%notification_template}}".
 *
 * @property integer $notification_template_id
 * @property string $event
 * @property string $title
 * @property string $type
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
            [['event', 'title', 'type', 'template', 'receiver'], 'required'],
            [['active'], 'integer'],
            [['event', 'title', 'type', 'receiver'], 'string', 'max' => 255],
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
            'title' => Yii::t('core_notification', 'Title'),
            'type' => Yii::t('core_notification', 'Type'),
            'template' => Yii::t('core_notification', 'Template'),
            'receiver' => Yii::t('core_notification', 'Receiver'),
            'active' => Yii::t('core_notification', 'Active'),
        ];
    }

    /**
     * get event info
     * @return array [$className, $eventName]
     */
    public function getEventInfo()
    {
        $eventParts = explode('::', $this->event);
        return [$eventParts[0], $eventParts[1]];
    }

    /**
     * get message with template fill the data to vars
     * @param array $data the data source
     * @return string
     */
    public function getMessage($data)
    {
        $varNames = $this->getVarNamesFromTemplate();
        $varValues = [];
        foreach ($varNames as $varName) {
            $varValues[$varName] = ArrayHelper::getValue($data, $varName);
        }
        return strtr($this->template, $varNames, $varValues);
    }

    /**
     * get send to receiver value maybe phone number or email address
     * @param $data
     * @return mixed
     */
    public function getReceiver($data)
    {
        return ArrayHelper::getValue($data, $this->receiver);
    }

    /**
     * get var names in template between left key and right key
     * @param string $leftKey
     * @param string $rightKey
     * @return array the var names
     */
    public function getVarNamesFromTemplate($leftKey = '{', $rightKey = '}')
    {
        $templateChars = str_split($this->template);
        $varNames = [];
        $tempVarName = [];
        $isVarChar = false;
        while($templateChars) {
            $char = array_shift($templateChars);
            if ($char == $leftKey) {
                $isVarChar = true;
                $tempVarName = [];
            } else if ($char == $rightKey && $isVarChar) {
                $varNames[] = implode('', $tempVarName);
                $isVarChar = false;
                $tempVarName = [];
            } else if ($isVarChar) {
                $tempVarName[] = $char;
            }
        }
        return $varNames;
    }
}
