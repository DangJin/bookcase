<?php
/**
 * Created by PhpStorm.
 * User: wry
 * Date: 18/2/3
 * Time: 上午11:03
 */

namespace app\admin\controller;


use think\Request;

class Drawer extends Common
{
    protected $model;

    public function __construct(Request $request = null)
    {
        parent::__construct($request);
        $this->model = new \app\admin\model\Drawer();
    }

    public function getOperate(Request $request)
    {
        $page = $request->has('page', 'param', true) ? $request->param('page') : 1;
        $limit = $request->has('limit', 'param', true) ? $request->param('limit') : 10;
        return $this->model->getOperate($request->param(), $page, $limit);
    }
}