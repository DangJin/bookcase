<?php
/**
 * Created by PhpStorm.
 * User: wry
 * Date: 18/2/1
 * Time: 下午5:54
 */

namespace app\admin\controller;


use think\Request;

class Borrow extends Common
{
    protected $model;

    public function __construct(Request $request = null)
    {
        parent::__construct($request);
        $this->model = new \app\admin\model\Borrow();
    }

    public function add(Request $request) {}

    public function update(Request $request) {}

    public function select(Request $request) {}

    public function delete(Request $request) {}

    public function getborrows(Request $request)
    {
        return $this->model->getborrows($request->param());
    }
}