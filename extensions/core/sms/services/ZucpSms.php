<?php
/**
 * @author Lujie.Zhou(lujie.zhou@jago-ag.cn)
 * @Date 6/17/2015
 * @Time 9:01 PM
 */

namespace core\sms\services;


use kiwi\sms\BaseSms;
use Yii;

class ZucpSms extends BaseSms
{

    public $sn;

    public $pwd;

    public $url = 'http://sdk2.entinfo.cn:8061/mdsmssend.ashx?';

    public $suffix = '';

    public function init()
    {
        $this->sn = Yii::$app->setting->zucpSn;
        $this->pwd = Yii::$app->setting->zucpPwd;
        $this->suffix = Yii::$app->setting->sucpSuffix;
    }

    protected function sendMessage($message, $phone)
    {
        $data = [
            'sn' => $this->sn,  //替换成您自己的序列号
            'pwd' => strtoupper(md5($this->sn . $this->pwd)),   //此处密码需要加密 加密方式为 md5(sn+password) 32位大写

            'mobile' => $phone,     //手机号 多个用英文的逗号隔开 post理论没有长度限制.推荐群发一次小于等于10000个手机号
            'content' => iconv("UTF-8", "gb2312//IGNORE", $message . $this->suffix),    //短信内容
            'ext' => '',
            'stime' => '',  //定时时间 格式为2011-6-29 11:09:21
            'rrid' => '',
            'msgfmt' => ''
        ];

        foreach ($data as $key => $value) {
            $data[$key] = $key . '=' . urlencode($value);
        }
        $params = implode('&', $data);

        $url = $this->url . $params;

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_HEADER, 0);
        curl_setopt($curl, CURLOPT_URL, $url);
        $response = curl_exec($curl);
        curl_close($curl);

        if ($response < 1) {
            return false;
        } else {
            return true;
        }
    }
}