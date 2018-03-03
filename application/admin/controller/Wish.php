<?php
/**
 * Created by PhpStorm.
 * User: wry
 * Date: 18/2/1
 * Time: 下午8:04
 */

namespace app\admin\controller;


use think\Request;

class Wish extends Common
{
    protected $model;

    public function __construct(Request $request = null)
    {
        parent::__construct($request);
        $this->model = new \app\admin\model\Wish();
    }

    public function add(Request $request) {}

    public function update(Request $request) {}

    public function select(Request $request) {}

    public function delete(Request $request) {}

    public function getwishs(Request $request) {
        return $this->model->getwishs($request->param());
    }
}