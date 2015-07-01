<?php
/**
 * @link http://www.yincart.com/
 * @copyright Copyright (c) 2014 Yincart
 * @license http://www.yincart.com/license/
 */

namespace kiwi\payment;

use kiwi\web\Controller;
use Yii;

class LocalPayServerController extends Controller
{
    public $enableCsrfValidation = false;

    protected $merchantTokens = ['localUserId' => 'localToken'];

    public $requestLogPath = '@runtime/localPay/';

    public function actionPay()
    {
        $data = Yii::$app->request->post();
        if ($this->validateRequestData($data)) {
            $callbackUrl = isset($data['callbackUrl']) ? $data['callbackUrl'] : false;
            unset($data['callbackUrl']);
            $returnUrl = isset($data['returnUrl']) ? $data['returnUrl'] : false;
            unset($data['returnUrl']);
            if ($callbackUrl) {
                $callbackData = $this->prepareCallbackData($data);
                $callbackResult = $this->sendCallbackRequest($callbackUrl, $callbackData);
            }
            if ($returnUrl) {
                $this->redirect($returnUrl);
            }
        }

        $payData = [
            'requestData' => $data,
            'callbackUrl' => isset($callbackUrl) ? $callbackUrl : 'false',
            'returnUrl' => isset($returnUrl) ? $returnUrl : 'false',
            'callbackData' => isset($callbackData) ? $callbackData : 'false',
            'callbackResult' => isset($callbackResult) ? $callbackResult : 'false',
        ];
        $this->savePay($payData);
    }

    public function savePay($data)
    {
        $time = microtime(true);
        $file = $this->requestLogPath . date('Ymd-His-', $time) . sprintf('%04d', (int) (($time - (int) $time) * 10000)) . '-' . sprintf('%04d', mt_rand(0, 10000)) . '.txt';
        $file = Yii::getAlias($file);

        foreach ($data as $key => $value) {
            $data[$key] = $key . ': ' . is_array($value) ? json_encode($value) : $value;
        }
        $dataStr = implode("\n", $data);

        file_put_contents($file, $dataStr);
    }

    protected function sendCallbackRequest($callbackUrl, $data)
    {
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_HEADER, 0);
        curl_setopt($curl, CURLOPT_URL, $callbackUrl);
        curl_setopt($curl, CURLOPT_POST, 1);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
        $result = curl_exec($curl);
        curl_close($curl);
        return $result;
    }

    protected function validateRequestData($data)
    {
        if (empty($data['merchantId']) || empty($this->merchantTokens[$data['merchantId']])) {
            return false;
        }

        $signStr = $this->getRequestSignature($data);
        return isset($data['Signature']) && strtoupper($data['Signature']) == strtoupper($signStr);
    }

    protected function prepareCallbackData($data)
    {
        $callbackData = [
            'merchantId' => $data['merchantId'],
            'transactionId' => $data['transactionId'],
            'money' => $data['money'],
            'status' => 1,
            'note' => 'localPay',
            'transactionTime' => time()
        ];
        $callbackData['Signature'] = $this->getCallbackSignature($callbackData);
        return $callbackData;
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
        $signStr = $signStr . $this->merchantTokens[$data['merchantId']];
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
        $signData[] = 'merchantToken=' . $this->merchantTokens[$data['merchantId']];
        $signStr = implode('~|~', $signData);
        $signStr = md5($signStr);
        return $signStr;
    }

} 