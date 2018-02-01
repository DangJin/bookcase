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
}