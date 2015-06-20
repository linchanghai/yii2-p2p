<?php
/**
 * @author Lujie.Zhou(lujie.zhou@jago-ag.cn)
 * @Date 12/16/2014
 * @Time 3:24 PM
 */

namespace core\payment\services;


use kiwi\payment\BasePayment;

class Chinabank extends BasePayment
{
    public $requestUrl = 'https://Pay3.chinabank.com.cn/PayGate';

    public $mid;

    public $mKey;

    public $bank = '';

    public $name = '';

    public function generateId()
    {
        return "chinabank" . time() . rand(10000, 99999);
    }

    public function prepareRequestData($money)
    {
        $requestData = [
            'v_mid' => $this->mid,
            'v_oid' => $this->getId(),
            'v_amount' => $money,
            'v_moneytype' => 'CNY',
            'v_url' => $this->callbackUrl,
            'v_pmode' => $this->bank,
            'remark1' => '',
            'remark2' => '[url:=' . $this->callbackUrl . ']', //服务器异步通知的接收地址。对应AutoReceive.php示例。必须要有[url:=]格式。
            'v_rcvname' => $this->name,
            'v_ordername' => '',
        ];
        $requestData['v_md5info'] = strtoupper($this->getRequestSignature($requestData));
        return $requestData;
    }

    public function getRequestSignature($data)
    {
        $md5 = '';
        $signKeys = ['v_amount', 'v_moneytype', 'v_oid', 'v_mid', 'v_url'];
        foreach ($signKeys as $key) {
            if (isset($data[$key])) {
                $md5 .= $data[$key];
            }
        }
        $md5 .= $this->mKey;
        $md5 = md5($md5);
        return $md5;
    }

    public function getCallbackSignature($data)
    {
        $md5 = '';
        $signKeys = ["v_oid", "v_pstatus", "v_amount", "v_moneytype"];
        foreach ($signKeys as $key) {
            if (isset($data[$key])) {
                $md5 .= $data[$key];
            }
        }
        $md5 .= $this->mKey;
        $md5 = md5($md5);
        return $md5;
    }

    /**
     * @inheritdoc
     */
    protected function validateCallbackData($data)
    {
        $signStr = $this->getCallbackSignature($data);
        return isset($data['v_md5str']) && strtoupper($data['v_md5str']) == strtoupper($signStr);
    }

    /**
     * @inheritdoc
     */
    protected function validatePaymentStatus($data)
    {
        return isset($data['v_pstatus']) && $data['v_pstatus'] == 20;
    }
} 