<?php
/**
 * Created by PhpStorm.
 * User: wry
 * Date: 18/1/26
 * Time: 下午3:40
 */

namespace app\admin\controller;


use think\Request;

class User extends Common
{
    protected $model;

    public function __construct(Request $request = null)
    {
        parent::__construct($request);
        $this->model = new \app\admin\model\User();
    }

    public function borrows(Request $request)
    {
        $page = empty($request->param('page')) ? 1 : $request->param('page');
        $limit = empty($request->param('limit')) ? 10 : $request->param('limit');
        return $this->model->borrows($request->param(), $page, $limit);
    }
}