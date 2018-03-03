<?php
//配置文件
return [
	'wxconfig' => [
		'app_id'        => 'wx5c1a89ec7428682c',
		'secret'        => '99d1e39ce049ba5beabe5ddc95e4833c',
		'token'         => 'titibook',
		'response_type' => 'array',
		'log'           => [
			'level'      => 'debug',
			'permission' => 0777,
			'file'       => '/home/wwwroot/tpbook.codwiki.cn/runtime/log/easywechat/easywechat.log',
		],
		'oauth'         => [
			'scopes'   => [ 'snsapi_userinfo' ],
			'callback' => '/weixin/oauth',
		],
	],
];