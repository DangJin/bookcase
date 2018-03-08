<?php
/**
 * Created by PhpStorm.
 * User: wry
 * Date: 18/3/8
 * Time: 下午4:42
 */

namespace app\index\controller;


use think\Request;

class Config extends Common
{
    private $model;

    public function __construct(Request $request = null)
    {
        parent::__construct($request);
        $this->model = new \app\index\model\Config();
    }

    public function getPayNum(Request $request)
    {
        return $this->model->getPayNum();
    }

    public function getDeposit(Request $request)
    {
        return $this->model->getDeposit();
    }
}