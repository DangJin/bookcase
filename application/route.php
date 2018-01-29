<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2018 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------

\think\Route::group( 'index', [
	'wallet' => [ 'index/wallet/index', [ 'method' => 'get' ] ],
] );

\think\Route::group( 'util', [
	'sendCode'          => [ 'util/alidayu/sendCode', [ 'method' => 'post' ] ],
	'status/getAlidayu' => [
		'util/globalStatus/getAlidayu',
		[ 'method' => 'GET' ],
	],
] );

\think\Route::group( 'weixin', [
	'init'     => [ 'wechat/index/index', [ 'method' => 'GET' ] ],
	'wxconfig' => [ 'wechat/jsSdk/getWxConfig', [ 'method' => 'POST' ] ],
	'oauth'    => [ 'wechat/oauth/oauth_callback', [ 'method' => 'GET' ] ],
] );