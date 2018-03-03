<?php

namespace app\wxpay\controller;

use think\Controller;
use think\Request;

class Jssdk extends Common
{

    public function __construct(\think\Request $request = null)
    {
        parent::__construct($request);
    }

    /**
     * @return \think\response\Json
     */
    public function getJssdk()
    {
        $jssdk = $this->payment->jssdk;
        // 生成订单号
        $prepayId = date('Ymd').str_pad(
                mt_rand(1, 99999), 5, '0', STR_PAD_LEFT
            );

        return returnJson(200, 200, $jssdk->sdkConfig($prepayId));
    }
}
