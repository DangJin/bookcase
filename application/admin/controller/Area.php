<?php
/**
 * Created by PhpStorm.
 * User: wry
 * Date: 18/2/6
 * Time: 下午11:33
 */

namespace app\admin\controller;


use think\Request;

class Area extends Common
{
    protected $model;

    public function __construct(Request $request = null)
    {
        parent::__construct($request);
        $this->model = new \app\admin\model\Area();
    }


}