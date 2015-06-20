<?php
/**
 * @author Lujie.Zhou(lujie.zhou@jago-ag.cn) 
 * @Date 6/19/2015
 * @Time 4:15 PM
 */

namespace kiwi\payment;


/**
 * Class LocalPay
 * @package kiwi\payment
 * @author Lujie.Zhou(lujie.zhou@jago-ag.cn)
 */
class LocalPay extends BasePayment
{
    public $merchantId = 'localUserId';

    public $merchantToken = 'localToken';

    public function generateId()
    {
        return date('YmdHis') . mt_rand(10000, 99999);
    }

    /**
     * @param $money
     * @return array
     */
    protected function prepareRequestData($money)
    {
        $requestData = [
            'merchantId' => $this->merchantId,
            'transactionId' => $this->getId(),
            'money' => $money,
            'callbackUrl' => $this->callbackUrl,
            'returnUrl' => $this->returnUrl,
        ];
        $requestData['Signature'] = $this->getRequestSignature($requestData);
        return $requestData;
    }

    protected function getRequestSignature($data)
    {
        $signKeys = ['merchantId', 'transactionId', 'money', 'callbackUrl', 'returnUrl'];
        $signData = [];
        foreach ($signKeys as $key) {
            if (isset($data[$key])) {
                $signData[] = $data[$key];
            }
        }

        $signStr = implode('|', $signData);
        $signStr = $signStr . $this->merchantToken;
        $signStr = md5($signStr);
        return $signStr;
    }

    protected function getCallbackSignature($data)
    {
        $signKeys = ['merchantId', 'transactionId', 'money', 'status', 'note', 'transactionTime'];
        $signData = [];
        foreach ($signKeys as $key) {
            if (isset($data[$key])) {
                $signData[] = $key . '=' . $data[$key];
            }
        }
        $signData[] = 'merchantToken=' . $this->merchantToken;
        $signStr = implode('~|~', $signData);
        $signStr = md5($signStr);
        return $signStr;
    }

    /**
     * @inheritdoc
     */
    protected function validateCallbackData($data)
    {
        $signStr = $this->getCallbackSignature($data);
        return isset($data['Signature']) && strtoupper($data['Signature']) == strtoupper($signStr);
    }

    /**
     * @inheritdoc
     */
    protected function validatePaymentStatus($data)
    {
        return isset($data['status']) && $data['status'] == 1;
    }
}