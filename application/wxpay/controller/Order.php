<?php

namespace app\wxpay\controller;

use think\Controller;
use think\Request;

class Order extends Common
{

    public function __construct(\think\Request $request = null)
    {
        parent::__construct($request);
    }

    public function orderUnify(Request $request)
    {
        // 业务类型，金额,此处自动获取用户 opendId  or7y7w6mgJIlh4sZpgBYcmnIR5qM
        // 1. 判断用户登录否
        // 2. 获取用户openid

    }

    public function notice()
    {

    }

}
