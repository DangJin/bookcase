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

\think\Route::group( 'admin', [

    //用户管理
    'user/select' => ['admin/user/select', ['method' => 'GET']],
    'user/update' => ['admin/user/update', ['method' => 'POST']],
    'user/delete' => ['admin/user/delete', ['method' => 'POST']],
    'user/add' => ['admin/user/add', ['method' => 'POST']],

    //报修类型管理
    'rtype/select' => ['admin/rtype/select', ['method' => 'GET']],
    'rtype/update' => ['admin/rtype/update', ['method' => 'POST']],
    'rtype/delete' => ['admin/rtype/delete', ['method' => 'POST']],
    'rtype/add' => ['admin/rtype/add', ['method' => 'POST']],

    //订单管理
    'order/select' => ['admin/order/select', ['method' => 'GET']],
    'order/update' => ['admin/order/update', ['method' => 'POST']],
    'order/delete' => ['admin/order/delete', ['method' => 'POST']],
    'order/add' => ['admin/order/add', ['method' => 'POST']],

    //订单管理
    'credet/select' => ['admin/creDet/select', ['method' => 'GET']],
//    'credet/update' => ['admin/creDet/update', ['method' => 'POST']],
//    'credet/delete' => ['admin/creDet/delete', ['method' => 'POST']],
//    'credet/add' => ['admin/creDet/add', ['method' => 'POST']],

] );