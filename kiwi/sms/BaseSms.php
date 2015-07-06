<?php
/**
 * @author Lujie.Zhou(lujie.zhou@jago-ag.cn) 
 * @Date 6/6/2015
 * @Time 1:08 PM
 */

namespace kiwi\sms;

use Yii;
use yii\base\Component;
use yii\base\InvalidConfigException;
use yii\base\ViewContextInterface;
use yii\web\View;

/**
 * Class BaseSms
 * @package kiwi\sms
 * @author Lujie.Zhou(lujie.zhou@jago-ag.cn)
 */
abstract class BaseSms extends Component implements SmsInterface
{
    /**
     * @event SmsEvent an event raised right before send.
     * You may set [[SmsEvent::isValid]] to be false to cancel the send.
     */
    const EVENT_BEFORE_SEND = 'beforeSend';
    /**
     * @event SmsEvent an event raised right after send.
     */
    const EVENT_AFTER_SEND = 'afterSend';

    public $useFileTransport = false;

    public $fileTransportPath = '@runtime/sms';

    public $fileTransportCallback;

    /**
     * Sends the given sms message.
     * This method will log a message about the sms being sent.
     * If [[useFileTransport]] is true, it will save the sms as a file under [[fileTransportPath]].
     * Otherwise, it will call [[sendMessage()]] to send the sms to its recipient(s).
     * Child classes should implement [[sendMessage()]] with the actual sms sending logic.
     * @param string $message sms message to be sent
     * @param string $phone the phone number to send to
     * @return boolean whether the message has been sent successfully
     */
    public function send($message, $phone)
    {
        if (!$this->beforeSend($message, $phone)) {
            return false;
        }

        Yii::info('Sending sms "' . $message . '" to "' . $phone . '"', __METHOD__);

        if ($this->useFileTransport) {
            $isSuccessful = $this->saveMessage($message, $phone);
        } else {
            $isSuccessful = $this->sendMessage($message, $phone);
        }
        $this->afterSend($message, $phone, $isSuccessful);

        return $isSuccessful;
    }

    /**
     * Sends the specified message.
     * This method should be implemented by child classes with the actual sms sending logic.
     * @param string $message sms message to be sent
     * @param string $phone the phone number to send to
     * @return boolean whether the message is sent successfully
     */
    abstract protected function sendMessage($message, $phone);

    /**
     * Saves the message as a file under [[fileTransportPath]].
     * @param string $message sms message to be sent
     * @param string $phone the phone number to send to
     * @return boolean whether the message is saved successfully
     */
    protected function saveMessage($message, $phone)
    {
        $path = Yii::getAlias($this->fileTransportPath);
        if (!is_dir(($path))) {
            mkdir($path, 0777, true);
        }
        if ($this->fileTransportCallback !== null) {
            $file = $path . '/' . call_user_func($this->fileTransportCallback, $this, $message, $phone);
        } else {
            $file = $path . '/' . $this->generateMessageFileName();
        }
        file_put_contents($file, $phone . ':' . $message);

        return true;
    }

    /**
     * @return string the file name for saving the message when [[useFileTransport]] is true.
     */
    public function generateMessageFileName()
    {
        $time = microtime(true);

        return date('Ymd-His-', $time) . sprintf('%04d', (int) (($time - (int) $time) * 10000)) . '-' . sprintf('%04d', mt_rand(0, 10000)) . '.txt';
    }

    /**
     * This method is invoked right before sms send.
     * You may override this method to do last-minute preparation for the message.
     * If you override this method, please make sure you call the parent implementation first.
     * @param string $message
     * @param string $phone
     * @return boolean whether to continue sending sms.
     */
    public function beforeSend($message, $phone)
    {
        $event = new SmsEvent(['message' => $message, 'phone' => $phone]);
        $this->trigger(self::EVENT_BEFORE_SEND, $event);

        return $event->isValid;
    }

    /**
     * This method is invoked right after sms was sent.
     * You may override this method to do some postprocessing or logging based on sms send status.
     * If you override this method, please make sure you call the parent implementation first.
     * @param string $message
     * @param string $phone
     * @param boolean $isSuccessful
     */
    public function afterSend($message, $phone, $isSuccessful)
    {
        $event = new SmsEvent(['message' => $message, 'phone' => $phone, 'isSuccessful' => $isSuccessful]);
        $this->trigger(self::EVENT_AFTER_SEND, $event);
    }
}