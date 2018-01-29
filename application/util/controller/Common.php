<?php

namespace app\util\controller;

use think\Controller;
use think\Request;

class Common extends Controller {

	public $global_status;

	public function __construct( Request $request = NULL ) {
		parent::__construct( $request );
		$this->global_status = new \app\util\model\GlobalStatus();
	}

}
