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

\think\Route::group( 'admin', [
	'user' => [ 'admin/user/add', [ 'method' => 'post' ] ],
] );

\think\Route::group( 'util', [
	'sendCode'          => [ 'util/alidayu/sendCode', [ 'method' => 'post' ] ],
	'test'              => [ 'util/index/index', [ 'method' => 'post' ] ],
	'status/getAlidayu' => [
		'util/globalStatus/getAlidayu',
		[ 'method' => 'GET' ],
	],
] );