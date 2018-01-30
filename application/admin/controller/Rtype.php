<?php
/**
 * Created by PhpStorm.
 * User: wry
 * Date: 18/1/30
 * Time: 下午6:50
 */

namespace app\admin\controller;


use think\Request;

class Rtype extends Common
{
    protected $model;

    public function __construct(Request $request = null)
    {
        parent::__construct($request);
        $this->model = new \app\admin\model\Rtype();
    }
}