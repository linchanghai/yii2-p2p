<?php
/**
 * @link http://www.yiikiwi.com/
 * @copyright Copyright (c) 2015 yiikiwi
 * @license http://www.yiikiwi.com/license/
 */

namespace core\payment\services;


use kiwi\payment\BasePaymentMethod;

class Sumapay extends BasePaymentMethod
{
    public $requestUrl = 'https://www.sumapay.com/sumapay/unitivepay_bankPayForNoLoginUser';

    public $partner;

    public $key;

    public function generateId()
    {
        return "sumapay" . date("YmdHis") . mt_rand(100000, 999999) . Yii::$app->user->id;
    }

    public function prepareRequestData($money)
    {
        $requestData = [
            'requestId' => $this->getId(),//订单号
            'tradeProcess' => $this->partner,
            'totalBizType' => 'BIZ01101',
            'totalPrice' => $money,
            'backurl' => $this->returnUrl,
            'returnurl' => $this->returnUrl,
            'noticeurl' => $this->callbackUrl,

            'productId' => Yii::$app->user->id . "_" . time() . "-" . substr(uniqid(rand()), -2),//产品编号
            'productName' => Yii::$app->user->id . "_" . time() . "-n-" . substr(uniqid(rand()), -6),//产品名称
            'fund' => $money,
            'merAcct' =>  $this->partner,
            'bizType' => 'BIZ01101',
            'productNumber' => '1',
        ];

        $extDataFields = ['description', 'rnaName', 'rnaIdNumber', 'rnaMobilePhone',
            'goodsDesc', 'userIdIdentity', 'allowRePay', 'rePayTimeOut', 'bankCardType',
            'productId', 'productName',
        ];
        foreach ($extDataFields as $key) {
            if (isset($data[$key])) {
                $requestData[$key] = $data[$key];
            } else if (empty($requestData[$key])) {
                $requestData[$key] = '';
            }
        }

        $requestData['mersignature'] = $this->getRequestSignature($requestData);
        return $requestData;
    }

    public function getRequestSignature($data)
    {
        $dataStr = '';
        $fields = [
            'requestId', 'tradeProcess', 'totalBizType', 'totalPrice',
            'backurl', 'returnurl', 'noticeurl', 'description'
        ];
        foreach ($fields as $key) {
            $dataStr .= $data[$key];
        }

        return $this->HmacMd5($dataStr, $this->key);
    }

    public function getCallbackSignature($data)
    {
        $dataStr = '';
        $fields = ['requestId', 'payId', 'fiscalDate', 'description'];
        foreach ($fields as $key) {
            $dataStr .= $data[$key];
        }

        return $this->HmacMd5($dataStr, $this->key);
    }

    /**
     * @inheritdoc
     */
    public function validateCallbackData($data)
    {
        $signStr = $this->getCallbackSignature($data);
        return isset($data['resultSignature']) && strtoupper($data['resultSignature']) == strtoupper($signStr);
    }

    /**
     * @inheritdoc
     */
    public function validatePaymentStatus($data)
    {
        return isset($data['requestId']) && isset($data['payId']);
    }

    /**
     * @inheritdoc
     */
    public function getCallbackId($data)
    {
        return isset($data['requestId']) ? $data['requestId'] : false;
    }

    private function HmacMd5($data, $key) {
        // RFC 2104 HMAC implementation for php.
        // Creates an md5 HMAC.
        // Eliminates the need to install mhash to compute a HMAC
        // Hacked by Lance Rushing(NOTE: Hacked means written)

        //需要配置环境支持iconv，否则中文参数不能正常处理
        $key = iconv("GB2312", "UTF-8", $key);
        $data = iconv("GB2312", "UTF-8", $data);

        $b = 64; // byte length for md5
        if (strlen($key) > $b) {
            $key = pack("H*", md5($key));
        }
        $key = str_pad($key, $b, chr(0x00));
        $ipad = str_pad('', $b, chr(0x36));
        $opad = str_pad('', $b, chr(0x5c));
        $k_ipad = $key ^ $ipad;
        $k_opad = $key ^ $opad;

        return md5($k_opad . pack("H*", md5($k_ipad . $data)));
    }
} 