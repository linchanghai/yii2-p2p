<?php
/**
 * @author Lujie.Zhou(lujie.zhou@jago-ag.cn) 
 * @Date 5/27/2015
 * @Time 7:57 PM
 */

namespace kiwi\base;


Trait SerializerTrait
{
    /**
     * @var string json or serialize or callable function
     */
    public $serializer = 'json';

    protected function serializeEncode($value)
    {
        if (is_array($value)) {
            if ($this->serializer == 'json') {
                return json_encode($value);
            }
            if ($this->serializer == 'serialize') {
                return serialize($value);
            }
            if (is_array($this->serializer) && $serializer = $this->serializer[0]) {
                if (is_callable($serializer)) {
                    return call_user_func($this->serializer, $value);
                }
            }
        }
        return false;
    }

    protected function serializeDecode($value, $isArray = true)
    {
        if (!is_array($value)) {
            if ($this->serializer == 'json') {
                return json_decode($value, $isArray);
            }
            if ($this->serializer == 'serialize') {
                return unserialize($value);
            }
            if (is_array($this->serializer) && $serializer = $this->serializer[1]) {
                if (is_callable($serializer)) {
                    return call_user_func($this->serializer, $value);
                }
            }
        }
        return false;
    }
}