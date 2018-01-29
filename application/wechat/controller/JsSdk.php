<?php
/**
 * Created by PhpStorm.
 * User: DangJin
 * Date: 2018-01-29
 * Time: 23:11
 */

namespace app\wechat\controller;


use think\Request;

class JsSdk extends Common {

	public function __construct( \think\Request $request = NULL ) {
		parent::__construct( $request );
	}


	/**
	 * 获取jssdk
	 *
	 * @param \think\Request $request
	 *
	 * @return \think\response\Json
	 * @throws \EasyWeChat\Kernel\Exceptions\InvalidConfigException
	 * @throws \Psr\SimpleCache\InvalidArgumentException
	 */
	public function getWxConfig( Request $request ) {
		$jsApiList = $request->param( 'jsApiList' );
		$debug     = $request->param( 'debug' );
		if ( empty( $debug ) || $debug === NULL ) {
			$debug = 0;
		}
		if ( empty( $jsApiList ) || $jsApiList === NULL ) {
			return returnJson( 400, 400, 'jsApiList 不得为空 / NULL' );
		}
		$config = $this->app->jssdk->buildConfig( explode( ",", $jsApiList ),
			$debug );

		return returnJson( 200, 200, json_decode( $config ) );
	}
}