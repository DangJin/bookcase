<?php
/**
 * Created by PhpStorm.
 * User: wry
 * Date: 18/2/1
 * Time: 下午3:09
 */

namespace app\admin\controller;


use think\Request;

class Config extends Common
{
    protected $model;

    public function __construct(Request $request = null)
    {
        parent::__construct($request);
        $this->model = new \app\admin\model\Config();
    }

    public function add(Request $request) {}

    public function delete(Request $request) {}

    public function update(Request $request) {}


    public function upcredit(Request $request)
    {
        return $this->model->upcredit($request->param());
    }

    public function addDeposit(Request $request)
    {
        return $this->model->addDeposit($request->param());
    }

    public function upDeposit(Request $request)
    {
        return $this->model->upDeposit($request->param());
    }

    public function delDeposit(Request $request)
    {
        return $this->model->delDeposit($request->param());
    }

    public function sesame(Request $request)
    {
        return $this->model->sesame($request->param());
    }

    public function addRecharge(Request $request)
    {
        return $this->model->addRecharge($request->param());
    }

    public function upRecharge(Request $request)
    {
        return $this->model->upRecharge($request->param());
    }

    public function delRecharge(Request $request)
    {
        return $this->model->delRecharge($request->param());
    }

    public function addDamage(Request $request)
    {
        return $this->model->addDamage($request->param());
    }

    public function upDamage(Request $request)
    {
        return $this->model->upDamage($request->param());
    }

    public function delDamage(Request $request)
    {
        return $this->model->delDamage($request->param());
    }
}