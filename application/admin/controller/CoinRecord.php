<?php
/**
 * Created by PhpStorm.
 * User: wry
 * Date: 18/3/2
 * Time: 下午2:49
 */

namespace app\admin\controller;


use think\Request;

class CoinRecord extends Common
{
    private $model;

    public function __construct(Request $request = null)
    {
        parent::__construct($request);
        $this->model = new \app\admin\model\CoinRecord();
    }

    public function 
}