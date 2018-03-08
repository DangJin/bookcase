<?php
/**
 * Created by PhpStorm.
 * User: wry
 * Date: 18/2/2
 * Time: 下午9:04
 */

namespace app\admin\controller;


use think\Request;
use ZipStream\ZipStream;

class Bookcase extends Common
{
    protected $model;

    public function __construct(Request $request = null)
    {
        parent::__construct($request);
        $this->model = new \app\admin\model\Bookcase();
    }

    public function add(Request $request)
    {
        if ($request->isPost())
        {
            if (!$request->has('csrf', 'header', true) || $request->header('csrf') != session('csrf'))
            {
                return returnJson(600, 400, '表单token验证失败');
            }
            session('csrf', md5($_SERVER['REQUEST_TIME_FLOAT']));
            return $this->model->add($request->param());
        }
    }

    public function getByArea(Request $request)
    {
        return $this->model->getByArea($request->param());
    }

    public function getManage(Request $request) {
        return $this->model->getManage($request->param());
    }

    public function getZip(Request $request)
    {
        if (!$request->has('dirname', 'param', true)) {
            return returnJson('400', '607', '缺少dirname参数');
        }
        $dirname = $request->param('dirname');
        $path = ROOT_PATH . 'public' . DS . 'uploads' . DS . $dirname;
        $files = scandir($path);
        $zip = new ZipStream($dirname.'.zip');
        foreach ($files as $file) {
            if ($file != '.' && $file != '..') {
                $zip->addFile($file, file_get_contents($path . DS . $file));
            }
        }
        $zip->finish();
    }

    public function bindManage(Request $request)
    {
        return $this->model->bindManage($request->param());
    }

}