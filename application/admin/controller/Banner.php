<?php
/**
 * Created by PhpStorm.
 * User: wry
 * Date: 18/3/6
 * Time: 上午10:28
 */

namespace app\admin\controller;


use think\Request;

class Banner extends Common
{
    protected $model;

    public function __construct(Request $request = null)
    {
        parent::__construct($request);
        $this->model = new \app\admin\model\Banner();
    }


}