<?php

namespace app\index\controller;

use think\Controller;
use think\Request;

class BookCase extends Common
{

    protected $bookcase;

    public function __construct(\think\Request $request = null)
    {
        parent::__construct($request);
        $this->bookcase = new \app\index\model\Bookcase();
    }


    /**
     * 获取书柜下所有抽屉
     *
     * @param \think\Request $request
     *
     * @return \think\response\Json
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public function drawers(Request $request)
    {
        if ( ! input('?get.case_id')) {
            return returnJson(400, 400, '必需参数不能为空');
        }
        $data = $this->bookcase->drawers(input('get.case_id'));
        if ( ! $data) {
            return returnJson(200, 200, '没有查找到此数据');
        }

        return returnJson(200, 200, $data);
    }

    /**
     * 获取某区域下所有书柜
     *
     * @param \think\Request $request
     *
     * @return \think\response\Json
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public function getBookcaseList(Request $request)
    {
        $city = $request->param('city');
        $lat  = $request->param('lat');
        $lng  = $request->param('lng');
        if ( ! isset($city) || ! isset($lat) || ! isset($lng)) {
            return returnJson(400, 400, '必需参数不能为空');
        }
        $data = $this->bookcase->casesList($city, $lat, $lng);
        if ( ! $data) {
            return returnJson(200, 200, '没有查找到此数据');
        }

        return returnJson(200, 200, $data);

    }

    public function getBookcaseBooks(Request $request)
    {
        if ( ! input('?get.case_id')) {
            return returnJson(400, 400, '必需参数不能为空');
        }

    }


}
