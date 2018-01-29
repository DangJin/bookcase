<?php
/**
 * Created by PhpStorm.
 * User: wry
 * Date: 18/1/26
 * Time: 下午3:40
 */

namespace app\admin\controller;


use think\Request;

class User extends Common
{
    protected $model;

    public function __construct(Request $request = null)
    {
        parent::__construct($request);
        $this->model = new \app\admin\model\User();
    }
}