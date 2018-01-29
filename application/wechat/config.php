<?php
//配置文件
return [
	'wxconfig' => [
		'app_id'        => 'wx33584f71b4a84fa9',
		'secret'        => '029b4c9b947564b763b0191445aabdca',
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