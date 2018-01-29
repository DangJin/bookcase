<?php

namespace app\util\controller;

use think\Controller;
use think\Request;

class GlobalStatus extends Common {


	public function __construct( \think\Request $request = NULL ) {
		parent::__construct( $request );
	}


	public function getAlidayu() {
		$status = $this->global_status->getStatus( 'alidayu' );

		return returnJson( 200, 200, $status );
	}

}
