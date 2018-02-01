<?php
/**
 * Created by PhpStorm.
 * User: wry
 * Date: 18/1/31
 * Time: 下午11:19
 */

namespace app\admin\controller;


use app\admin\model\CreaditDetail;
use think\Request;

class CreDet extends Common
{
    protected $model;

    public function __construct(Request $request = null)
    {
        parent::__construct($request);
        $this->model = new CreaditDetail();
    }
}