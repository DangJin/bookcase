<?php
/**
 * Created by PhpStorm.
 * User: wry
 * Date: 18/3/2
 * Time: 下午3:36
 */

namespace app\admin\controller;


use think\Request;

class Memcard extends Common
{
    private $model;

    public function __construct(Request $request = null)
    {
        parent::__construct($request);
        $this->model = new \app\admin\model\Memcard();
    }

}