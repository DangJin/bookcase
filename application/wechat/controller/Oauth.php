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
use think\Session;

class Oauth extends Controller
{

    private $app;
    private $wxConfig;

    public function __construct(\think\Request $request = null)
    {
        parent::__construct($request);
        Config::load(APP_PATH.'/wechat/config.php');
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
        if (Session::get('wx_user')) {
            return returnJson(200, 200, Session::get('wx_user'));
        }
        $oauth           = $this->app->oauth;
        $user            = $oauth->user();
        $uid             = $this->getUserId($user);
        $user_arr        = $user->toArray();
        $user_arr['uid'] = $uid;
        // 写Session
        Session::set("wx_user", $user_arr);

        return returnJson(200, 200, $user_arr);
    }

    /**
     * @param \Overtrue\Socialite\User $user
     *
     * @return mixed|string
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
                return $_user['id'];
            } else {
                $data = [
                    'openid'      => $openid,
                    'name'        => $user_arr['original']['nickname'],
                    'headimg'     => $user_arr['original']['headimgurl'],
                    'gender'      => $user_arr['original']['sex'],
                    'type'        => 1,
                    'create_time' => date("Y-m-d H:i:s", strtotime('now')),
                    'modity_time' => date("Y-m-d H:i:s", strtotime('now')),
                ];

                $res = Db::table('user')->insert($data);
                if ($res === 1) {
                    return Db::name('user')->getLastInsID();
                }
            }

        }
    }
}