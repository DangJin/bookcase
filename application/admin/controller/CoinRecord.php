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
    protected $model;

    public function __construct(Request $request = null)
    {
        parent::__construct($request);
        $this->model = new \app\admin\model\CoinRecord();
    }

    public function getDetails(Request $request)
    {
        $limit = $request->has('limit', 'param', true) ?  $request->param('limit') : 10;
        $page = $request->has('page', 'param', true) ?  $request->param('page') : 1;
        return $this->model->getDetails($page, $limit);
    }
}