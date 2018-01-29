<?php

namespace app\util\controller;

use app\util\model\GlobalStatus;
use Flc\Alidayu\Requests\AlibabaAliqinFcSmsNumSend;
use Flc\Alidayu\Client;
use Flc\Alidayu\App;
use think\Config;
use think\exception\ErrorException;
use think\Request;

class Index extends Common {


	public function __construct( Request $request = NULL ) {
		parent::__construct( $request );
	}

	public function index( Request $req ) {
		$status = $this->global_status->getStatus( 'wxpay' );

		return returnJson( 200, 200, $status );
	}


}
