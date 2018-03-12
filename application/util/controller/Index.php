<?php

namespace app\util\controller;

use app\util\model\GlobalStatus;
use Flc\Alidayu\Requests\AlibabaAliqinFcSmsNumSend;
use Flc\Alidayu\Client;
use Flc\Alidayu\App;
use think\Config;
use think\exception\ErrorException;
use think\Request;

class Index extends Common
{


    public function __construct(Request $request = null)
    {
        parent::__construct($request);
    }

    //	public function index( Request $req ) {
    //		$status = $this->global_status->getStatus( 'wxpay' );
    //
    //		return returnJson( 200, 200, $status );
    //	}

    public function index()
    {
        $app_key   = "8253586fd5ec900ecde7728f6d7d29cd";
        $timestamp = time();
        dump(md5($app_key.$timestamp));
    }


}
