<?php
/**
 * Created by PhpStorm.
 * User: wry
 * Date: 18/3/3
 * Time: 下午4:43
 */

namespace app\admin\controller;


use think\Request;

class ItypeImg extends Common
{
    protected $model;

    public function __construct(Request $request = null)
    {
        parent::__construct($request);
        $this->model = new \app\admin\model\ItypeImg();
    }

    public function add(Request $request)
    {
        if (!$request->has('itid', 'param', true)) {
            return returnJson(603, 400, '缺少问题类型ID');
        }
        $file = $request->file('img');
        $data = [];
        if ($file) {
            $info = $file->move(ROOT_PATH . 'public' . DS . 'uploads');
            if ($info) {
                $data['path'] = ROOT_PATH . 'public' . DS . 'uploads' . DS . $info->getSaveName();
                $data['imgurl'] = $request->host(). DS . 'images' . DS . $info->getSaveName();
                $data['itid'] = $request->param('itid');
            } else {
                return returnJson(609, 400, '上传失败');
            }
            return $this->model->add($data);
        } else {
            return returnJson(609, 400, $file->getError());
        }
    }

    public function delete(Request $request)
    {
        return $this->model->del($request->param());
    }
}