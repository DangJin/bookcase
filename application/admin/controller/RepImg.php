<?php
/**
 * Created by PhpStorm.
 * User: wry
 * Date: 18/3/6
 * Time: 上午9:57
 */

namespace app\admin\controller;


use think\Controller;
use think\Request;

class RepImg extends Common
{
    protected $model = '';


    public function __construct(Request $request = null)
    {
        parent::__construct($request);
        $this->model = new \app\admin\model\RepImg();
    }

    public function add(Request $request)
    {
        $file = $request->file('img');
        $data = [];
        if ($file) {
            $info = $file->move(ROOT_PATH . 'public' . DS . 'uploads');
            if ($info) {
                $data['path'] = ROOT_PATH . 'public' . DS . 'uploads' . DS . $info->getSaveName();
                $data['imgurl'] = DS . DS . $request->host(). DS . 'images' . DS . $info->getSaveName();
            } else {
                return returnJson(609, 400, $info->getError());
            }
            return $this->model->add($data);
        } else {
            return returnJson(609, 400, '没有上传图片');
        }
    }

    public function update(Request $request)
    {
        return returnJson(800, 400, '没有此接口');
    }

    public function select(Request $request)
    {
        return returnJson(800, 400, '没有此接口');
    }

    public function delete(Request $request)
    {
        return $this->model->del($request->param());
    }
}