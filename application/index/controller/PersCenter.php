<?php

namespace app\index\controller;

use app\index\model\Order;
use app\index\model\User;
use think\Controller;
use think\Db;
use think\Request;
use think\Session;

class PersCenter extends Common
{

    /**
     * 在接，已还
     *
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public function myBorrow(Request $request)
    {
        $user_id = 1;
        //        $user_id = $request->param('user_id');
        $state = $request->param('type');
        $page  = $request->param('page', 1);
        $limit = $request->param('limit', 10);
        if (empty($user_id) || empty($state)) {
            return returnJson(400, 400, '必需参数不能为空');
        }
        $buyout = Db::table('borrow')->where('borrow.create_user', $user_id)
            ->where(
                'borrow.state', $state
            )->join(
                'books bs', 'borrow.bid=bs.id'
            )->join('book b', 'bs.pid=b.id')->field(
                'b.id,b.title,b.press,b.author,b.cover'
            )->page($page, $limit)->select();

        return returnJson(200, 200, $buyout);
    }

    /**
     * 我的余额
     *
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
     * 我的阅读币
     *
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
     * 我的押金
     *
     * @return \think\response\Json
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public function myDeposit()
    {
        //        $user_id = Session::get('user_id');
        $user_id = 4;
        $data    = Db::table('user')->where('id', $user_id)->field('deposit')
            ->find();

        return returnJson(200, 200, $data);
    }

    /**
     * 我的阅读币
     *
     * @return \think\response\Json
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public function myReadCard()
    {
        //        $user_id = Session::get('user_id');
        $user_id = 4;
        $data    = Db::table('user')->where('id', $user_id)->field('coin')
            ->find();

        return returnJson(200, 200, $data);
    }

    /**
     * 我的心愿单
     *
     * @param \think\Request $request
     *
     * @return \think\response\Json
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public function myWish(Request $request)
    {
        //        $user_id = $request->param('user_id');
        $user_id = 4;
        $page    = $request->param('page', 1);
        $limit   = $request->param('limit', 10);
        //        if (empty($user_id)) {
        //            return returnJson(400, 400, '必需参数不能为空');
        //        }
        $wish = Db::table('wish')->where('wish.create_user', $user_id)->join(
            'book', 'book.id=wish.bid'
        )->field('book.title,book.author,book.press,book.isbn,book.cover')
            ->page(
                $page, $limit
            )->select();

        return returnJson(200, 200, $wish);
    }


    /**
     * 个人资料获取
     *
     * @return \think\response\Json
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public function userProfile(Request $request)
    {
        //        $user_id = Session::get('user_id');
        //                $user_id = 23;
        $user_id = $request->param("uid");
        $sign    = new \app\index\model\Sign();
        // 判断是否是连续签到
        if ( ! $sign->lastIsSign($user_id)) {
            // 设置为 0
            $user = new User();
            $user->resetSign($user_id);
        }
        $data = Db::table('user')->where('id', $user_id)->field(
            'name,openid,headimg,phone,gender,sign,money,deposit'
        )
            ->find();

        $data['isSign'] = $sign->isSign($user_id);


        return returnJson(200, 200, $data);
    }


    /**
     * 我的买断单
     *
     * @throws \think\Exception
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public function myBuyout()
    {
        //        $user_id = Session::get('user_id');
        $user_id = 2;

        $order = new Order();
        $data  = $order->bought($user_id);

        return returnJson(200, 200, $data);
    }


    public function getFAQ()
    {

    }
}
