<?php
/**
 * Created by PhpStorm.
 * User: DangJin
 * Date: 2018-01-29
 * Time: 23:43
 */

namespace app\wechat\controller;


use EasyWeChat\Factory;
use Overtrue\Socialite\User;
use think\Config;
use think\Controller;
use think\Db;
use think\Log;

class Oauth extends Controller
{

    private $app;
    private $wxConfig;

    public function __construct(\think\Request $request = null)
    {
        parent::__construct($request);
        Config::load(APP_PATH . '/wechat/config.php');
        if (Config::has('wxconfig')) {
            $this->wxConfig = Config::get('wxconfig');
        }
        $this->app = Factory::officialAccount($this->wxConfig);
    }


    /**
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public function oauth_callback()
    {
        $oauth = $this->app->oauth;
        $user  = $oauth->user();
        // 业务逻辑
        session('wx_user', $user->toArray());
        $this->getUserId($user);
        $target_url = session('target_url');
        if ( ! empty($target_url)) {
            header('location:' . $target_url); // 跳转到 user/profile
        }
    }

    /**
     * @param \Overtrue\Socialite\User $user
     *
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public function getUserId(User $user)
    {
        $user_arr = $user->toArray();
        $openid   = $user->getId();
        if ( ! empty($openid)) {
            $_user = Db::table('user')->where('openid', $openid)->find();
            if ( ! empty($_user)) {
                session('user_id', $_user['id']);
            } else {
                $data = [
                    'openid'  => $openid,
                    'name'    => $user_arr['original']['nickname'],
                    'headimg' => $user_arr['original']['headimgurl'],
                    'gender'  => $user_arr['original']['sex'],
                ];

                $res = Db::table('user')->insert($data);
                if ($res === 1) {
                    session('user_id', Db::name('user')->getLastInsID());
                }
            }

        }
    }
}