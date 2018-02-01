<?php
/**
 * Created by PhpStorm.
 * User: DangJin
 * Date: 2018-01-30
 * Time: 0:11
 */

namespace app\wechat\controller;


use EasyWeChat\Factory;
use think\Config;
use think\Controller;
use think\Log;
use think\Request;

class WxLogin extends Controller
{

    public function __construct(\think\Request $request = null)
    {
        parent::__construct($request);
        Config::load(APP_PATH . '/wechat/config.php');
        if (Config::has('wxconfig')) {
            $wxConfig  = Config::get('wxconfig');
            $this->app = Factory::officialAccount($wxConfig);
            $oauth     = $this->app->oauth;
            if (empty(session('wx_user'))) {
                session('target_url', $request->url());
                $oauth->redirect()->send();
            }
        }
    }


}