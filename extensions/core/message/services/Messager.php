<?php
/**
 * @link http://www.yincart.com/
 * @copyright Copyright (c) 2014 Yincart
 * @license http://www.yincart.com/license/
 */

namespace core\message\services;


use kiwi\Kiwi;
use yii\base\Component;

class Messager extends Component
{
    /**
     * @param \core\message\models\Message $message
     * @return true
     */
    public function send($message)
    {
        return $message->save();
    }

    public function compose($data = [])
    {
        return Kiwi::getMessage($data);
    }
} 