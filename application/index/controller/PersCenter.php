<?php

namespace app\index\controller;

use think\Controller;
use think\Db;
use think\Request;
use think\Session;

class PersCenter extends Controller
{

    /**
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public function myBorrow(Request $request)
    {
        $user_id = $request->param('user_id');
        $state   = $request->param('state');
        $page    = $request->param('page', 1);
        $limit   = $request->param('limit', 10);
        if (empty($user_id) || empty($state)) {
            return returnJson(400, 400, '必需参数不能为空');
        }
        $buyout = Db::table('borrow')->where('borrow.create_user', $user_id)
            ->where(
                'borrow.state', $state
            )->join(
                'books bs', 'borrow.bid=bs.id'
            )->join('book b', 'bs.pid=b.id')->field(
                'b.title,b.price,b.buyout,b.author'
            )->page($page, $limit)->select();

        return returnJson(200, 200, $buyout);
    }

    /**
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public function myBalance()
    {
        //        $user_id = Session::get('user_id');
        $user_id = 4;
        $data    = Db::table('user')->where('id', $user_id)
            ->field('handsel,money')->find();

        // 组装数据
        return returnJson(
            200, 200, [
                'money'   => $data['money'],//可提现余额
                'handsel' => $data['handsel'],// 赠送余额
                'total'   => $data['money'] + $data['handsel'],// 所有余额
            ]
        );
    }


    /**
     * @return \think\response\Json
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public function myReadCoin()
    {
        //        $user_id = Session::get('user_id');
        $user_id = 4;
        $data    = Db::table('user')->where('id', $user_id)->field('coin')
            ->find();

        return returnJson(200, 200, $data);
    }

    /**
     * @return \think\response\Json
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public function myDeposit()
    {
        $user_id = 4;
        $data    = Db::table('user')->where('id', $user_id)->field('deposit')
            ->find();

        return returnJson(200, 200, $data);
    }

    public function myReadCard()
    {
    }

    /**
     * @param \think\Request $request
     *
     * @return \think\response\Json
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public function myWish(Request $request)
    {
        $user_id = $request->param('user_id');
        $page    = $request->param('page', 1);
        $limit   = $request->param('limit', 10);
        if (empty($user_id)) {
            return returnJson(400, 400, '必需参数不能为空');
        }
        $wish = Db::table('wish')->where('wish.create_user', $user_id)->join(
            'book', 'book.id=wish.bid'
        )->field('book.title,book.author,book.press,book.isbn')->page(
            $page, $limit
        )->select();

        return returnJson(200, 200, $wish);
    }

    /**
     * @return \think\response\Json
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public function isSign()
    {
        //        $user_id = Session::get('user_id');
        $user_id = 4;
        $data    = Db::table('user')->where('id', $user_id)->field('sign')
            ->find();

        return returnJson(200, 200, $data);
    }


    /**
     * @return \think\response\Json
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public function userProfile()
    {
        //        $user_id = Session::get('user_id');
        $user_id = 4;
        $data    = Db::table('user')->where('id', $user_id)->field(
            'name,openid,headimg,phone,gender,sign,money,deposit'
        )
            ->find();

        return returnJson(200, 200, $data);
    }
}
