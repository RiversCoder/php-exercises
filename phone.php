<?php

class Message
{

    private $phone = "133xxxx5188";
    private $RequestUrl = "https://api.mysubmail.com/message/xsend";

    public function __construct()
    {
        $this->sendMessage();
    }

    private function httpRequest($data)
    {
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $this->RequestUrl);
        curl_setopt($curl, CURLOPT_HEADER, 0);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);

        if (isset($data)) {
            curl_setopt($curl, CURLOPT_POST, 1);
            curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
        }

        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, true); // 只信任CA颁布的证书
        curl_setopt($curl, CURLOPT_CAINFO, dirname(__FILE__) . '/resource/cacert.pem'); // CA根证书（用来验证的网站证书是否是CA颁布）
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 2); // 检查证书中是否设置域名，并且是否与提供的主机名匹配*/
        /*
        CURLOPT_SSL_VERIFYHOST的值:

        -> 设为0表示不检查证书
        -> 设为1表示检查证书中是否有CN(common name)字段
        -> 设为2表示在1的基础上校验当前的域名是否与CN匹配
         */

        $res = curl_exec($curl);
        var_dump(curl_error($curl));
        curl_close($curl);
        return $res;
    }

    private function makeCode($length)
    {
        $max = pow(10, $length) - 1;
        $min = pow(10, $length - 1);

        return mt_rand($min, $max);
    }

    private function sendMessage()
    {
        $appId = "xxxxx";
        $appKey = "36426a9f6xxxxxxxxxxxxd8583a3c";
        $code = $this->makeCode(6);

        $data = [
            "appid" => $appId,
            "to" => $this->phone,
            "project" => "xxxxxx",
            "vars" => '{"code":' . $code . ',"time":"60"}',
            "signature" => $appKey,
        ];

        $res = $this->httpRequest($data);

        var_dump($res);
    }
}

new Message();
