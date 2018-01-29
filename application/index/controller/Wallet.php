<?php
/**
 * Created by PhpStorm.
 * User: DangJin
 * Date: 2018-01-30
 * Time: 0:16
 */

namespace app\index\controller;


use app\wechat\controller\WxLogin;

class Wallet extends WxLogin {

	public function __construct( \think\Request $request = NULL ) {
		parent::__construct( $request );
	}

	public function index() {

		session( 'wx_user', NULL );
		dump( session( 'target_url' ) );
	}
}