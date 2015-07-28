<?php

namespace core\message\models;

use Yii;
use yii\web\IdentityInterface;

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

    /**
     * @param \core\message\services\Messager $messager
     * @return bool
     */
    public function send($messager = null)
    {
        $messager = $messager ?: Yii::$app->message;
        return $messager->send($this);
    }

    public function setTitle($title)
    {
        $this->title = $title;
        return $this;
    }

    public function setContent($content)
    {
        $this->content = $content;
        return $this;
    }

    /**
     * @param IdentityInterface|array|string|int $to
     * @return $this
     */
    public function setTo($to)
    {
        $this->to = $this->handleFromTo($to);
        return $this;
    }

    public function setFrom($from)
    {
        $this->from = $this->handleFromTo($from);
        return $this;
    }

    protected function handleFromTo($fromTo)
    {
        if ($fromTo instanceof IdentityInterface) {
            $fromTo = $fromTo->getId();
        } else if (is_array($fromTo)) {
            /** @var IdentityInterface $identityClass */
            $identityClass = Yii::$app->user->identityClass;
            $fromTo = $identityClass::findOne($fromTo);
            $fromTo = $fromTo->getId();
        }
        return $fromTo;
    }

    public function getUnreadMessageCount(){
        return $this->find()->where(['to'=>Yii::$app->user->id,'status'=>0])->count();
    }
}
