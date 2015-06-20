<?php
/**
 * @author Lujie.Zhou(lujie.zhou@jago-ag.cn)
 * @Date 6/17/2015
 * @Time 9:01 PM
 */

namespace core\sms\services;


use kiwi\sms\BaseSms;

class ZucpSms extends BaseSms
{

    public $sn;

    public $pwd;

    protected function sendMessage($message, $phone)
    {
        $data = [
            'sn' => $this->sn,  //替换成您自己的序列号
            'pwd' => strtoupper(md5($this->sn . $this->pwd)),   //此处密码需要加密 加密方式为 md5(sn+password) 32位大写

            'mobile' => $phone,     //手机号 多个用英文的逗号隔开 post理论没有长度限制.推荐群发一次小于等于10000个手机号
            'content' => iconv("UTF-8", "gb2312//IGNORE", $message),    //短信内容
            'ext' => '',
            'stime' => '',  //定时时间 格式为2011-6-29 11:09:21
            'rrid' => ''
        ];

        foreach ($data as $key => $value) {
            $data[$key] = $key . '=' . urlencode($value);
        }
        $params = implode('&', $data);
        $length = strlen($params);

        $fp = fsockopen("sdk2.zucp.net", 8060, $errorNo, $errorMsg, 10) or exit($errorMsg . "--->" . $errorNo);

        $header = "POST /webservice.asmx/mt HTTP/1.1\r\n";
        $header .= "Host:sdk2.zucp.net\r\n";
        $header .= "Content-Type: application/x-www-form-urlencoded\r\n";
        $header .= "Content-Length: " . $length . "\r\n";
        $header .= "Connection: Close\r\n\r\n";
        $header .= $params . "\r\n";

        fputs($fp, $header);

        $inheader = 1;
        while (!feof($fp)) {
            $line = fgets($fp, 1024); //去除请求包的头只显示页面的返回数据
            if ($inheader && ($line == "\n" || $line == "\r\n")) {
                $inheader = 0;
            }
        }

        $line = str_replace("
<string xmlns=\"http://tempuri.org/\">", "", $line);
        $line = str_replace("</string>
", "", $line);
        $result = explode("-", $line);
        if (count($result) > 1) {
            return false;
        } else {
            return true;
        }
    }
}