<?php

namespace core\notification\models;

use kiwi\Kiwi;
use Yii;
use yii\helpers\ArrayHelper;

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
            [['event', 'type', 'title', 'template', 'active'], 'required'],
            [['active'], 'integer'],
            [['event', 'type', 'title', 'receiver'], 'string', 'max' => 255],
            [['template'], 'string', 'max' => 1023],
            ['event', 'in', 'range' => array_keys(Kiwi::getDataListModel()->notificationEvents)],
            ['type', 'in', 'range' => array_keys(Kiwi::getDataListModel()->notificationTypes)],
            ['receiver', 'default', 'value' => function ($model, $attribute) {
                switch ($model->type) {
                    case 'sms':
                        return 'user.mobile';
                    case 'mail':
                        return 'user.email';
                    default:
                        return 'user.id';
                }
            }],
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
        foreach ($varNames as $varKey => $varName) {
            $varValues[$varKey] = ArrayHelper::getValue($data, $varName);
        }
        return strtr($this->template, $varValues);
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
        while ($templateChars) {
            $char = array_shift($templateChars);
            if ($char == $leftKey) {
                $isVarChar = true;
                $tempVarName = [];
            } else if ($char == $rightKey && $isVarChar) {
                $tempVarName = implode('', $tempVarName);
                $varNames[$leftKey . $tempVarName . $rightKey] = $tempVarName;
                $isVarChar = false;
                $tempVarName = [];
            } else if ($isVarChar) {
                $tempVarName[] = $char;
            }
        }
        return $varNames;
    }
}
