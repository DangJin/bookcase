<?php
/**
 * Created by PhpStorm.
 * User: wry
 * Date: 18/3/2
 * Time: 下午2:47
 */

namespace app\admin\controller;


use think\Request;

class CoinDet extends Common
{
    protected $model;

    public function __construct(Request $request = null)
    {
        parent::__construct($request);
        $this->model = new \app\admin\model\CoinDet();
    }
}