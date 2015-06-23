<?php
/**
 * @author Lujie.Zhou(lujie.zhou@jago-ag.cn)
 * @Date 12/17/2014
 * @Time 1:57 PM
 */

namespace core\payment\services;


use kiwi\payment\BasePaymentMethod;

class Ecpss extends BasePaymentMethod
{
    public $requestUrl = 'https://pay.ecpss.com/sslpayment';
//    public $requestUrl = 'https://pay.ips.net.cn/ipayment.aspx';    //测试环境

    public $merNo;

    public $products = '';

    public $MD5key;

    public function generateId()
    {
        return date("YmdHis") . mt_rand(100000, 999999);
    }

    public function prepareRequestData($money)
    {
        $requestData = [
            'MerNo' => $this->merNo,
            'BillNo' => $this->getId(),

            'Amount' => $money,
            'ReturnURL' => $this->returnUrl,
            'AdviceURL' => $this->callbackUrl,
            'Remark' => date("YmdHis"),  //交易时间
            'orderTime' => date("YmdHis") . mt_rand(1000, 9999),  //流水号

            'shippingFirstName' => '',
            'shippingLastName' => '',
            'shippingEmail' => '',
            'shippingPhone' => '',
            'shippingZipcode' => '',
            'shippingAddress' => '',
            'shippingCity' => '',
            'shippingState' => '',
            'shippingCountry' => '',
            'products' => $this->products,
        ];
        $requestData['MD5info'] = $this->getRequestSignature($requestData);
        return $requestData;
    }

    public function getRequestSignature($data)
    {
        $md5 = '';
        $signKeys = ['MerNo', 'BillNo', 'Amount', 'ReturnURL'];
        foreach ($signKeys as $key) {
            if (isset($data[$key])) {
                $md5 .= $data[$key];
            }
        }
        $md5 .= $this->MD5key;
        $md5 = strtoupper(md5($md5));
        return $md5;
    }

    public function getCallbackSignature($data)
    {
        $md5 = '';
        $signKeys = ["BillNo", "Amount", "Succeed"];
        foreach ($signKeys as $key) {
            if (isset($data[$key])) {
                $md5 .= $data[$key] . "&";
            }
        }
        $md5 .= $this->MD5key;
        $md5 = strtoupper(md5($md5));
        return $md5;
    }

    /**
     * @inheritdoc
     */
    public function validateCallbackData($data)
    {
        $signStr = $this->getCallbackSignature($data);
        return isset($data['SignMD5info']) && strtoupper($data['SignMD5info']) == strtoupper($signStr);
    }

    /**
     * @inheritdoc
     */
    public function validatePaymentStatus($data)
    {
        return isset($data['Succeed']) && $data['Succeed'] == 88;
    }

    /**
     * @inheritdoc
     */
    public function getCallbackId($data)
    {
        return isset($data['BillNo']) ? $data['BillNo'] : false;
    }
} 