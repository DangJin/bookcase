<?php
/**
 * Created by PhpStorm.
 * User: wry
 * Date: 18/2/1
 * Time: 下午8:44
 */

namespace app\admin\controller;


use think\Request;

class Comment extends Common
{
    protected $model;

    public function __construct(Request $request = null)
    {
        parent::__construct($request);
        $this->model = new \app\admin\model\Comment();
    }

    public function searchByName(Request $request)
    {
        return $this->model->searchByName($request->param());
    }
}