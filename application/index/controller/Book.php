<?php

namespace app\index\controller;

use app\index\model\BookDet;
use app\index\model\BooImg;
use app\index\model\Wish;
use think\Controller;
use think\Request;
use think\Session;

class Book extends Common
{

    private $book;

    public function __construct(\think\Request $request = null)
    {
        parent::__construct($request);
        $this->book = new \app\index\model\Book();
    }


    /**
     * 获取图书主要相信信息
     *
     * @param \think\Request $request
     *
     * @return \think\response\Json
     * @throws \think\Exception
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public function getBookInfo(Request $request)
    {
        $id = $request->param('book_id');
        if (empty($id)) {
            return returnJson(400, 400, '必须参数不能为空');
        }
        $data = $this->book->bookInfo($id);
        if ( ! $data) {
            return returnJson(200, 200, '暂无数据');
        }

        return returnJson(200, 200, $data);
    }


    /**
     * 获取图书目录
     *
     * @param \think\Request $request
     *
     * @return \think\response\Json
     * @throws \think\Exception
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public function getBookCatelog(Request $request)
    {
        $id      = $request->param('book_id');
        $catelog = new BookDet();
        if (empty($id)) {
            return returnJson(400, 400, '必须参数不能为空');
        }
        $data = $catelog->catelog2book($id);
        if ( ! $data) {
            return returnJson(200, 200, '暂无数据');
        }
        //        $data['catalog'] = str_replace("\\n", "<br>", $data['catalog']);
        $data['catalog'] = "<ul><li>".str_replace("\\n", "</li><li>", $data['catalog'])."</li></ul>";

        $img          = new BooImg();
        $imgs         = $img->img2book($id);
        $data['imgs'] = $imgs;

        return returnJson(200, 200, $data);
    }


    /**
     * 加入心愿单
     *
     * @param \think\Request $request
     *
     * @return \think\response\Json
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public function add2Wish(Request $request)
    {
        $book_id = $request->param('book_id');
        //        $uid     = Session::get('user_id');
        $uid = 4;
        if (empty($book_id)) {
            return returnJson(400, 400, '必须参数不能为空');
        }
        $wish = new Wish();
        if ( ! $wish->hasWish($uid, $book_id)) {
            return returnJson(200, 200, '心愿已存在，不能重复添加');
        }
        $data = $wish->addBook2wish($uid, $book_id);
        if ($data) {
            return returnJson(200, 200, '加入成功');
        }

        return returnJson(400, 400, '加入失败');
    }


    /**
     * 生成订单信息
     *
     * @param \think\Request $request
     *
     * @return array|bool|\think\response\Json
     * @throws \think\Exception
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public function Order4Buy(Request $request)
    {
        $book_id = $request->param('book_id');
        if (empty($book_id)) {
            return returnJson(400, 400, '必须参数不能为空');
        }
        $data = $this->book->bookPrice($book_id);

        if ($data) {
            return returnJson(200, 200, $data);
        }

        return returnJson(400, 400, '获取失败');
    }

    public function borrow(Request $request)
    {
        // 判断用户状态
        // 判断图书状态
    }

    public function backBook(Request $request)
    {
        $book_id  = $request->param('book_id');
        $order_id = $request->param('order_id');
        $user_id  = Session::get('');

        $data = $this->book->bookInfo($book_id);
        // 计算借阅时间
        // 计算租金
        // 获取损坏状态  租金 + 定价 * 百分比
    }

}
