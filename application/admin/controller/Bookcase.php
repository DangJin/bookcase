<?php
/**
 * Created by PhpStorm.
 * User: wry
 * Date: 18/2/2
 * Time: 下午9:04
 */

namespace app\admin\controller;


use think\Request;

class Bookcase extends Common
{
    protected $model;

    public function __construct(Request $request = null)
    {
        parent::__construct($request);
        $this->model = new \app\admin\model\Bookcase();
    }

    public function add(Request $request)
    {
        return $this->model->add($request->param());
    }

    public function getByArea(Request $request)
    {
        return $this->model->getByArea($request->param());
    }

    public function getManage(Request $request) {
        return $this->model->getManage($request->param());
    }
}