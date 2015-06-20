<?php
/**
 * @author Lujie.Zhou(lujie.zhou@jago-ag.cn)
 * @Date 6/19/2015
 * @Time 5:17 PM
 */

namespace kiwi\payment;

use Yii;
use yii\base\Action;

class LocalPayServerAction extends Action
{
    protected $merchantTokens = ['localUserId' => 'localToken'];

    public $requestLogPath = '@runtime/localPay';

    public function run()
    {
        $data = Yii::$app->request->post();
        if ($this->validateRequestData($data)) {
            $callbackUrl = isset($data['callbackUrl']) ? $data['callbackUrl'] : false;
            unset($data['callbackUrl']);
            $returnUrl = isset($data['returnUrl']) ? $data['returnUrl'] : false;
            unset($data['callbackUrl']);
            if ($callbackUrl) {
                $callbackData = $this->prepareCallbackData($data);
                $result = $this->sendCallbackRequest($callbackUrl, $callbackData);
                $this->saveCallbackRequest($callbackUrl, $callbackData, $result);
            }
            if ($returnUrl) {
                $this->controller->redirect($returnUrl);
            }
        }
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

    protected function saveCallbackRequest($callbackUrl, $callbackData, $result)
    {
        $time = microtime(true);
        $file = date('Ymd-His-', $time) . sprintf('%04d', (int) (($time - (int) $time) * 10000)) . '-' . sprintf('%04d', mt_rand(0, 10000)) . '.txt';

        file_put_contents($file, $callbackUrl . "\n" . json_encode($callbackData) . "\n" . $result);
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