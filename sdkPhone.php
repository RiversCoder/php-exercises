<?php

//加载submail平台的类文件
require './resource/messagexsend.php';

class SdkPhone
{

    public $phone = '133xxxx9752';
    public $code = '123122';

    public function __construct()
    {
        $this->sendPhone();
    }

    private function sendPhone()
    {
        $submail = new MESSAGEXsend();
        $submail->setTo($this->phone);
        $submail->SetProject('xxxxx');
        $submail->AddVar('time', 60);
        $submail->AddVar('code', $this->code);
        $xsend = $submail->xsend();

        //判断返回结果
        if ($xsend['status'] !== 'success') {
            $this->returnMsg(400, $xsend['msg']);
        } else {
            $this->returnMsg(200, '手机验证码发送成功，每天发送5次，请在一分钟内验证！');
        }
    }

    private function returnMsg($code, $msg = '', $data = [])
    {
        $return_data['code'] = $code;
        $return_data['msg'] = $msg;
        $return_data['data'] = $data;

        echo json_encode($return_data);die;
    }
}

new SdkPhone();
