<?php

namespace app\index\controller;

use app\index\model\Config;
use think\Controller;
use think\Request;

class Order extends Common
{

    private $order;

    public function __construct(\think\Request $request = null)
    {
        parent::__construct($request);
        $this->order = new \app\index\model\Order();
    }


    /**
     * 获取快捷支付金额配置
     *
     * @return \think\response\Json
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public function getPayConfig()
    {
        $config = new Config();
        $data   = $config->getPayNum();

        return returnJson(200, 200, explode(',', $data));
    }

    public function createOrder(Request $request)
    {
        return $this->order->createOrder($request->param());
    }

}
