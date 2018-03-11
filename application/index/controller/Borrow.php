<?php

namespace app\index\controller;

use think\Controller;
use think\Request;

class Borrow extends Common
{

    private $borrow;

    public function __construct(\think\Request $request = null)
    {
        parent::__construct($request);
        $this->borrow = new \app\index\model\Borrow();
    }

    // 查询借阅信息

    public function getLease(Request $request)
    {
        $borrow_id = $request->param('borrow_id');
        if (empty($borrow_id)) {
            return returnJson(400, 400, '必需参数为空');
        }
        // 查询信息
        $data = $this->borrow->getLeaseInfo($borrow_id);
        // 计算租借时间，查出相关价格
        $now         = date('Y-m-d');
        $borrow_time = date('Y-m-d', $data['borrow_start']);

        dump($now);

        // 查询图书价格
    }

    public function getBorrowOrder(Request $request)
    {
        return $this->borrow->getBorrowOrder($request->param());
    }

    public function showOrder(Request $request)
    {
        return $this->borrow->showOrder($request->param());
    }

    public function addBorrow(Request $request)
    {
        return $this->borrow->addBorrow($request->param());
    }
}
