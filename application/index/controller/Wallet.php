<?php
/**
 * Created by PhpStorm.
 * User: DangJin
 * Date: 2018-01-30
 * Time: 0:16
 */

namespace app\index\controller;


use app\wechat\controller\WxLogin;

class Wallet extends WxLogin
{

    public function __construct(\think\Request $request = null)
    {
        parent::__construct($request);
    }

    public function index()
    {

        session('wx_user', null);
        dump(session('user_id'));
    }
}