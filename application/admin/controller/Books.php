<?php
/**
 * Created by PhpStorm.
 * User: wry
 * Date: 18/2/2
 * Time: 下午3:34
 */

namespace app\admin\controller;


use think\Request;

class Books extends Common
{
    protected $model;

    public function __construct(Request $request = null)
    {
        parent::__construct($request);
        $this->model = new \app\admin\model\Books();
    }

    public function add(Request $request) {}

    public function update(Request $request) {}

    public function delall(Request $request)
    {
        return $this->model->delall($request->param());
    }
}