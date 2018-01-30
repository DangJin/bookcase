<?php

namespace app\wechat\controller;

use EasyWeChat\Factory;
use EasyWeChat\Work\Application;
use think\Config;
use think\Controller;
use think\Request;

class Common extends Controller {

	protected $wxConfig;
	protected $app;

	public function __construct( \think\Request $request = NULL ) {
		parent::__construct( $request );
		if ( Config::has( 'wxconfig' ) ) {
			$this->wxConfig = Config::get( 'wxconfig' );
		}
		$this->app = Factory::officialAccount( $this->wxConfig );
	}

}
