<?php

namespace app\index\controller;

use think\Controller;
use think\Request;

class Common extends Controller
{

    public function __construct(\think\Request $request = null)
    {
        parent::__construct($request);
        header('Access-Control-Allow-Origin: *');
        header('Access-Control-Allow-Credentials: true');
        header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');
        header(
            "Access-Control-Allow-Headers: Origin, X-Requested-With, access-token, refresh-token, Content-Type, Accept, csrf, authKey, sessionId"
        );
        header('Content-Type:text/html; charset=utf-8');
    }
}
