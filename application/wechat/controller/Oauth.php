<?php
/**
 * Created by PhpStorm.
 * User: DangJin
 * Date: 2018-01-29
 * Time: 23:43
 */

namespace app\wechat\controller;


use EasyWeChat\Factory;
use think\Config;
use think\Controller;

class Oauth extends Controller {

	private $app;
	private $wxConfig;

	public function __construct( \think\Request $request = NULL ) {
		parent::__construct( $request );
		Config::load( APP_PATH . '/wechat/config.php' );
		if ( Config::has( 'wxconfig' ) ) {
			$this->wxConfig = Config::get( 'wxconfig' );
		}
		$this->app = Factory::officialAccount( $this->wxConfig );
	}

	/**
	 * 授权页面
	 */
	public function oauth_callback() {
		$oauth = $this->app->oauth;
		$user  = $oauth->user();
		session( 'wx_user', $user->toArray() );
		$target_url = session( 'target_url' );
		header( 'location:' . $target_url ); // 跳转到 user/profile
	}
}