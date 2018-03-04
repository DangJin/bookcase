<?php
/**
 * Created by PhpStorm.
 * User: wry
 * Date: 18/2/1
 * Time: 下午9:36
 */

namespace app\admin\controller;


use think\Request;

class Book extends Comment
{
    protected $model;

    public function __construct(Request $request = null)
    {
        parent::__construct($request);
        $this->model = new \app\admin\model\Book();
    }

    public function addinv(Request $request)
    {
        if ($request->isPost()) {
//            if (!$request->has('csrf', 'header', true) || $request->header('csrf') != session('csrf')) {
//                return returnJson(600, 400, '表单token验证失败');
//            }
//            session('csrf', md5($_SERVER['REQUEST_TIME_FLOAT']));
            return $this->model->addinv($request->param());
        }
    }

    public function getDateRank(Request $request)
    {
        return $this->model->getDateRank($request->param());
    }

    public function getTimeRank(Request $request)
    {
        return $this->model->getTimeRank($request->param());
    }

    public function getAmountRank(Request $request)
    {
        return $this->model->getAmountRank($request->param());
    }

    public function getBuyRank(Request $request)
    {
        return $this->model->getBuyRank($request->param());
    }

}