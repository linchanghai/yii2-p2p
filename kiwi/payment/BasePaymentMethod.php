<?php
/**
 * Created by PhpStorm.
 * User: chalin
 * Date: 6/23/2015
 * Time: 5:10 PM
 */

namespace kiwi\payment;

use Yii;
use yii\base\Object;

/**
 * Class BasePaymentMethod
 *
 * @property int $id
 *
 * @package kiwi\payment
 */
abstract class BasePaymentMethod extends Object
{
    public $requestUrl;

    public $callbackUrl;

    public $returnUrl;

    private $_id;

    public function getId()
    {
        if (!$this->_id) {
            $this->_id = $this->generateId();
        }
        return $this->_id;
    }

    /**
     * @return string generate the transaction no
     */
    abstract public function generateId();

    /**
     * @param $money
     * @return array
     */
    abstract public function prepareRequestData($money);

    /**
     * @param $data
     * @return bool check if the signature data is correct
     */
    abstract public function validateCallbackData($data);

    /**
     * @param $data
     * @return bool check if the payment is successful
     */
    abstract public function validatePaymentStatus($data);

    /**
     * @param $data
     * @return string the transaction id
     */
    abstract public function getCallbackId($data);

} 