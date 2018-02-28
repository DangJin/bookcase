<?php
/**
 * Created by PhpStorm.
 * User: wry
 * Date: 18/2/7
 * Time: 下午6:58
 */

namespace app\admin\controller;


use think\Request;

class BanImg extends Common
{
    protected $model;

    public function __construct(Request $request = null)
    {
        parent::__construct($request);
        $this->model = new \app\admin\model\BanImg();
    }

    public function add(Request $request)
    {
        $file = $request->file('img');
        $data = [];
        if ($file) {
            $info = $file->move(ROOT_PATH . 'public' . DS . 'uploads');
            if ($info) {
                $data['path'] = ROOT_PATH . 'public' . DS . 'uploads' . DS . $info->getSaveName();
                $data['imgurl'] = $request->host(). DS . 'images' . DS . $info->getSaveName();
                $time = date('Y-m-d H:i:s', strtotime('noe'));
                $data['name'] =
                $data['create_user'] = session('id');
                $data['modify_user'] = session('id');
                $data['url'] = $request->has('url', 'param', true) ? $request->param('url') : '';
            } else {
                return returnJson(609, 400, '上传失败');
            }
            return $this->model->add($data);
        } else {
            return returnJson(609, 400, $file->getError());
        }

    }
}